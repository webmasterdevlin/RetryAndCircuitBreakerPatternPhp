<?php

namespace App\Http\Controllers;

use Illuminate\Cache\RateLimiter;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;

class TodoController extends Controller
{
    private string $baseUrl = 'http://localhost:8001/api/';

    public function show($todo_id): JsonResponse
    {
        $limiter = app(RateLimiter::class);
        $action_key = 'todo_service';
        $threshold = 2;

        if ($limiter->tooManyAttempts($action_key, $threshold)) {
            return new JsonResponse([
                "message" => "Exceeded the maximum number of failed attempts. Please wait for a minute"],
                500);
        } else {
            $response = Http::get($this->baseUrl . 'todos/' . $todo_id);

            if ($response->status() == 500) {
                error_log("--> FacadeApi RECEIVED a FAILURE");
                $limiter->hit($action_key, Carbon::now()->addMinutes(1));
                return new JsonResponse(["message" => "The server is not responding."], 500);
            } else {
                error_log("--> FacadeApi RECEIVED a SUCCESS");
                $data = $response->json();
                return new JsonResponse($data, 200);
            }
        }
    }
}
