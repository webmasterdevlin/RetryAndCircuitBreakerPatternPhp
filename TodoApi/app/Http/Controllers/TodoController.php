<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class TodoController extends Controller
{
    public function show($todo_id): JsonResponse
    {
        $random_number = rand(0, 100);
        $data = ["id" => $todo_id, "activity" => $random_number];
        return response()->json($data, 200);
    }
}
