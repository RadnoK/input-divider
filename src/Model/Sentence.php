<?php

declare(strict_types=1);

namespace App\Model;

use App\Exception\InvalidSentenceValueException;
use App\Model\Collection\CollectionInterface;
use App\Model\Collection\WordCollection;

final class Sentence
{
    /** @var string */
    private $value;

    public function __construct(string $value)
    {
        $this->validate($value);

        $value = trim($value, ' ');

        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }

    private function validate(string $value): void
    {
        if ('' === $value) {
            return;
        }

        if (preg_match('/^[a-zA-Z\!\?\.\s]+$/', $value)) {
            return;
        }

        throw new InvalidSentenceValueException();
    }
}
