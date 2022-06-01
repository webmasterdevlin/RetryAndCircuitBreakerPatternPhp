<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class TodoController extends Controller
{
    public function show($todo_id): JsonResponse
    {
        $random_number = rand(0, 100);
        if ($random_number >= $todo_id) {
            error_log("--> TodoService Returned 500 ERROR");
            return response()->json(['message' => 'Todo Service is down'], 500);
        }
        error_log("--> TodoService Returned 200 OK");
        $data = ["id" => $todo_id, "activity" => "eat"];
        return response()->json($data, 200);
    }
}
