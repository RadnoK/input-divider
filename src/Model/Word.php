<?php

declare(strict_types=1);

namespace App\Model;

use App\Exception\InvalidWordValueException;

final class Word
{
    /** @var string */
    private $value;

    public function __construct(string $value)
    {
        $this->validate($value);

        $value = str_replace('.', '', $value);

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
        if (0 < strlen($value)) {
            return;
        }

        throw new InvalidWordValueException();
    }
}
