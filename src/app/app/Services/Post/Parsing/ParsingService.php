<?php

namespace App\Services\Post\Parsing;

use App\Domain\Post\Entity\Post;

interface ParsingService
{
    /**
     * @return array|Post[]
     */
    public function parse(): array;
}
