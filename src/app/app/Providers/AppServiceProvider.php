<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Domain\Post\Entity\PostRepository;
use App\Infrastructure\Domain\Entity\LumenPostRepository;

use App\Services\Post\Parsing\RbcParsingService;
use App\Services\Post\Parsing\ParsingService;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(PostRepository::class, LumenPostRepository::class);
        $this->app->bind(ParsingService::class, RbcParsingService::class);
    }
}
