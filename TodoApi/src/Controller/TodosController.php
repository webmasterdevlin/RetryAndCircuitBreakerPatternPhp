<?php

namespace App\Controller;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpClient\RetryableHttpClient;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;


class TodosController extends AbstractController
{

    /**
     * @throws Exception
     */
    #[Route('/todos/{id}', name: 'todo_by_id', methods: ['GET'])]
    public function show($id): JsonResponse
    {
        $random_number = rand(0, 100);
        if ($random_number >= $id) {
            error_log("--> TodoService Returned 500 ERROR");
            throw new Exception('Invalid strength passed '.$id);
        }
        error_log("--> TodoService Returned 200 OK");
        $data = ["id" => $id, "activity" => "eat"];
        return new JsonResponse($data, 200);
    }
}
