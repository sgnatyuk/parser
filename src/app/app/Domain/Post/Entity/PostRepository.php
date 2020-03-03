<?php

namespace App\Domain\Post\Entity;

interface PostRepository
{
    /**
     * @return array
     */
    public function findAll(): array;

    public function findById(string $id): array;

    public function saveMany(array $entities): bool;
}
