<?php

namespace App\Http\Controllers\Concerns;

use App\Transformers\RestfulTransformer;
use Illuminate\Http\Request;

trait Restful
{
    protected $transformer;
    /**
     * Figure out which transformer to use
     * 
     * Order of precedence:
     * - Controller specified
     * - Model specified
     * - Base (extends RestfulTransformer)
     * 
     * @return RestfulTransformer
     */
    protected function getTransformer()
    {
        $transformer = null;

        // Check if controller specifies a resource
        if (!is_null(static::$transformer)) {
            $transformer = static::$transformer;
        } else {
            // If it is, check if the controller's model specifies the transformer
            if (!is_null(static::$model)) {
                // If it does, use it
                if (!is_null((static::$model)::$transformer)) {
                    $transformer = (static::$model)::$transformer;
                }
            }
        }

        // This is the default transformer, if one is not specified
        if (is_null($transformer)) {
            $transformer = RestfulTransformer::class;
        }

        if (!empty(static::$defaultIncludesTransformer)) {
            return (new $transformer)->setDefaultIncludes(static::$defaultIncludesTransformer);
        }

        return new $transformer;
    }

    /**
     * Check if this request's body input is a collection of objects or not
     * 
     * @return bool
     */
    protected function isRequestBodyACollection(Request $request)
    {
        $input = $request->input();

        // Check that the top-level of the body is an array
        if (is_array($input) && count($input) > 0) {
            // Check if the first element is an array (json Object)
            $firstChild = array_shift($input);

            if (is_array($firstChild)) {
                return true;
            }
        }

        return false;
    }

    /**
     * This method determines whether the resource returned should undergo transformation or not.
     * The reason is, sometimes it is useful to return the untransformed resource (for example - for internal calls)
     * 
     * @return bool
     */
    protected function shouldTransform()
    {
        return true;
    }

    /**
     * Prepend a Response message with a custom message
     * Useful for adding error info to internal request responses before returning them
     * 
     * @param \Dingo\Api\Http\Response $response
     * @param $message
     * @return \Dingo\Api\Http\Response
     */
    protected function prependResponseMessage($response, $message)
    {
        $content            = $response->getOriginalContent();
        $content['message'] = $message . $content['message'];
        $response->setContent($content);

        return $response;
    }

    /**
     * Try to find the relation name of the child model in the parent model
     * 
     * @param $parent Object Parent model instance
     * @param $child string Child model name
     * @return null\string
     */
    protected function getChildRelationNameForParent($parent, $child)
    {
        // Try model plural name
        $manyName = model_relation_name($child, 'many');

        if (method_exists($parent, $manyName)) {
            return $manyName;
        }

        // Try model singgular name
        $oneName = model_relation_name($child, 'one');

        if (method_exists($parent, $oneName)) {
            return $oneName;
        }
    }
}
