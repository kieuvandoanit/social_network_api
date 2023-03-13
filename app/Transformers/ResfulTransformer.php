<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use Illuminate\Database\Eloquent\Model as RestfulModel;

class RestfulTransformer extends TransformerAbstract
{
    /**
     * @var RestfulModel The model to be transformed
     */
    protected $model = null;

    /**
     * Transform an object into a jsonable array
     * 
     * @param mixed $model
     * @return array
     * @throws \Exception
     */
    public function transform($object)
    {
        if (is_object($object) && $object instanceof RestfulModel) {
            $transformed = $this->transformRestfulModel($object);
        } elseif (is_object($object) && $object instanceof \stdClass) {
            $transformed = $this->transformStdClass($object);
        } else {
            throw new \Exception('Unexpected object type encountered in transformed');
        }

        return $transformed;
    }

    /**
     * Transform an arbitrary stdClass
     * 
     * @param \stdClass $object
     * @return array
     */
    public function transformStdClass($object) {
        $transformed = (array) $object;
        return $transformed;
    }

    /**
     * Transform an eloquent object into a jsonable array
     * 
     * @param RestfulModel $model
     * @return array
     */
    public function transformRestfulModel(RestfulModel $model) {
        $this->model = $model;

        // Begin the transformation!
        $transformed = $model->toArray();

        /**
         * Filter out attributes we don't want to expose to the API
         */
        $filterOutAttribute = $this->getFilteredOutAttributes();

        $transformed = array_filter($transformed, function ($key) use ($filterOutAttribute) {
            return !in_array($key, $filterOutAttribute);
        }, ARRAY_FILTER_USE_KEY);

        /**
         * Format all dates as Iso8601 strings, this includes the created_at, updated_at columns
         */
        foreach ($model->getDates() as $dateColumn) {
            if (!empty($model->$dateColumn) && !in_array($dateColumn, $filterOutAttribute)) {
                $transformed[$dateColumn] = $model->$dateColumn->toIso8601String();
            }
        }

        /**
         * Primary key transformation - all PKs to be called "id"
         */

         $transformed = array_merge(
            ['id' => $model->getKey()],
            $transformed
         );

         /**
          * Get the relations for this object and transform them
          */

          return $transformed;
    }

    /**
     * Filter out some attributes immediately
     * 
     * Some attributes we never want to expose to an API consumer, for security and separation of concerns reasons
     * Feel free to override this function as necessary
     * 
     * @return array Array of attributes to filter out
     */
    protected function getFilteredOutAttributes()
    {
        $filterOutAttributes = array_merge(
            $this->model->getHidden(),
            [
                $this->model->getKeyName(),
                // 'deleted_at'
            ]
            );

            return array_unique($filterOutAttributes);
    }

    /**
     * Do relation transformations
     * 
     * @param array $transformed
     * @return array $transformed
     */
    protected function transformRelations(array $transformed)
    {
        // Iterate through all_relations
        foreach ($this->model->getRelations() as $relationKey => $relation) {
            // Skip Pivot
            if ($relation instanceof \Illuminate\Database\Eloquent\Relations\Pivot) {
                continue;
            } elseif ($relation instanceof \Illuminate\Database\Eloquent\Collection) {
                if (count($relation->getIterator()) > 0) {
                    $relationModel = $relation->first();
                    $relationTransformer = $relationModel::getTransformer();

                    // Transform related model collection
                    if ($this->model->$relationKey) {
                        // Create empty array for relation
                        $transformed[$relationKey] = [];

                        foreach ($relation->getIterator() as $key => $relatedModel) {
                            // Replace the related models with their transformed selves
                            $transformedRelateModel = $relationTransformer->transform($relatedModel);

                            // We don't really care about pivot information at this stage
                            if (isset($transformedRelateModel['pivot'])) {
                                unset($transformedRelateModel['pivot']);
                            }

                            // Add transformed model to relation array
                            $transformed[$relationKey][] = $transformedRelateModel;
                        }
                    }
                }
            } elseif ($relation instanceof RestfulModel) {
                // Get transformer of relation model
                $relationTransformer = $relation::getTransformer();

                if ($this->model->relationKey) {
                    $transformed[$relationKey] = $relationTransformer->transform($this->model->relationKey);
                }
            }
        }

        return $transformed;
    }
}
