<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Cache\RateLimiter;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;

class TodoController extends Controller
{
    private string $baseUrl = 'http://localhost:8001/api/';

    public function show($todo_id): JsonResponse
    {
        try {
            $response = Http::retry(3, 5000)->get($this->baseUrl . 'todos/' . $todo_id);
            error_log("--> FacadeApi RECEIVED a SUCCESS");
            $data = $response->json();
            return new JsonResponse($data, 200);
        } catch (Exception $e) {
            error_log("--> FacadeApi RECEIVED a FAILURE");
            return new JsonResponse(["message" => "The server is not responding after 3 attempts."], 500);
        }
    }
}
