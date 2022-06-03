<?php

namespace App\Controller;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpClient\RetryableHttpClient;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;


class TodosController extends AbstractController
{
    private string $baseUrl = 'http://localhost:8001/api/';

    #[Route('/todos/{id}', name: 'todo_by_id', methods: ['GET'])]
    public function show($id): JsonResponse
    {
        try {
            $client_retry = new RetryableHttpClient(HttpClient::create());
            $client = new Client(['base_uri' => $this->baseUrl]);
            $response = $client->request('GET', 'todos/' . $id);
            $data = json_decode($response->getBody()->getContents(), true);
            return new JsonResponse($data);
        } catch (GuzzleException $e) {
            return new JsonResponse([
                'error' => 'Todo ' . $id .' not found'
            ], 500);
        }
    }
}
