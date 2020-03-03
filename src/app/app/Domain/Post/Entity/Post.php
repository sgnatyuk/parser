<?php

namespace App\Domain\Post\Entity;

use App\Domain\Uuid;

class Post
{
    private $id;
    private $url;
    private $title;
    private $image;
    private $short;
    private $text;
    private $createdAt;
    private $updatedAt;

    public function __construct(
        Uuid $id,
        string $url,
        string $title,
        ?string $image,
        string $short,
        array $text
    ) {
        $this->id = $id;
        $this->url = $url;
        $this->title = $title;
        $this->image = $image;
        $this->short = $short;
        $this->text = $text;
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTimeImmutable();
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function getShort(): string
    {
        return $this->short;
    }

    public function getText(): array
    {
        return $this->text;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): \DateTimeImmutable
    {
        return $this->updatedAt;
    }
}
