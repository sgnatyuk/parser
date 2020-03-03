<?php

namespace App\Http\Controllers;

use App\Jobs\ParseJob;
use Illuminate\Http\JsonResponse;

use App\Domain\Post\Entity\PostRepository;
use App\Services\Post\Parsing\ParsingService;
use Illuminate\Support\Facades\Queue;
use Symfony\Component\HttpFoundation\Response;

class IndexController extends Controller
{
    private $posts;
    private $parsingService;

    public function __construct(
        PostRepository $posts,
        ParsingService $parsingService
    ) {
        $this->posts = $posts;
        $this->parsingService = $parsingService;
    }

    public function index(): Response
    {
        return new JsonResponse($this->posts->findAll());
    }

    public function show(string $id): Response
    {
        return new JsonResponse($this->posts->findById($id));
    }

    public function save(): Response
    {
        Queue::push(
            new ParseJob(
                $this->posts,
                $this->parsingService
            )
        );

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }
}
