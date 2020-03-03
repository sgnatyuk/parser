<?php

namespace App\Domain;

use Webmozart\Assert\Assert;

class Uuid
{
    private $value;

    public function __construct(string $value)
    {
        Assert::notEmpty($value);

        $this->value = $value;
    }

    public static function next(): self
    {
        return new self(\Ramsey\Uuid\Uuid::uuid4()->toString());
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
