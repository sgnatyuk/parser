<?php

namespace App\Jobs;

use App\Domain\Post\Entity\PostRepository;
use App\Events\FinishedParsing;
use App\Services\Post\Parsing\ParsingService;

class ParseJob extends Job
{
    private $posts;
    private $parsingService;

    public function __construct(PostRepository $posts, ParsingService $parsingService)
    {
        $this->posts = $posts;
        $this->parsingService = $parsingService;
    }

    public function handle()
    {
        $this->posts->saveMany(
            $this->parsingService->parse()
        );

        broadcast(new FinishedParsing($this->posts->findAll()));
    }
}
