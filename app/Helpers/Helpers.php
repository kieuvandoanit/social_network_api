<?php

use App\Http\CustomResponse\CustomJsonResponse;

function prepareResponse($data, $perPage = 1, $total = 1, $currentPage = 1) {
    return [
        "total"         => $total,
        "currentPage"   => $currentPage,
        "perPage"       => $perPage,
        "data"          => $data,
    ];
}

function normalResponse($eloquentModel, $transformer, $perPage = 10, $page = 0) {
    $totalRecords = $eloquentModel->toArray()[0]['total_records'] ?? 0;
    $data = fractal()->collection($eloquentModel)
            ->transformWith($transformer)
            ->toArray();
    
    return new CustomJsonResponse([
        "total"         => $totalRecords,
        "currentPage"   => $page,
        "perPage"       => $perPage,
        "data"          => $data["data"],
    ]);
}

function failResponse($data, $statusCode=400) {
    return response()->json($data, $statusCode);
}

function splitObject($data) {
    if (count($data) == 0) {
        return null;
    } else {
        $total_records = $data[0]['total_records'];
        // foreach ($data as &$object) {
        //     unset($object['total_records']);
        // }

        $model = array_map(function($element) {
            unset($element['total_records']);
            return $element;
        }, $data);

        return array(
            "total_records" => $total_records,
            "data"          => $model,
        );
    }
}
