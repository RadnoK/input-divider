<?php

declare(strict_types=1);

namespace App\Model;

use App\Exception\InvalidSentenceValueException;

final class Input
{
    /** @var string */
    private $value;

    public function __construct(string $value)
    {
        $this->validate($value);

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
        $length = strlen($value);

        if (0 > $length || 100 < $length) {
            throw new InvalidSentenceValueException();
        }
    }
}
