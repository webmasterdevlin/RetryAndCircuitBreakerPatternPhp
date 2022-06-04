<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class TodoController extends Controller
{
    private string $baseUrl = 'http://localhost:8001/api/';

    public function show($todo_id): JsonResponse
    {
        $response = Http::get($this->baseUrl . 'todos/' . $todo_id);
        if ($response->status() === 500) {
            error_log("--> FacadeApi RECEIVED a FAILURE");
            return new JsonResponse([
                'error' => 'Todo ' . $todo_id .' not found'
            ], 500);
        } else {
            error_log("--> TodoService RECEIVED a SUCCESS");
            $data = $response->json();
            return new JsonResponse($data, 200);
        }
    }
}
