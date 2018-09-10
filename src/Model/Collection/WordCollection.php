<?php

declare(strict_types=1);

namespace App\Model\Collection;

use App\Model\Word;

final class WordCollection
{
    /** @var array */
    private $words = [];

    private function __construct(array $words = [])
    {
        $this->words = $words;
    }

    public static function createEmpty(): self
    {
        return new self();
    }

    public static function fromArray(array $words): self
    {
        $wordCollection = self::createEmpty();

        foreach ($words as $word) {
            $wordCollection->add($word);
        }

        return $wordCollection;
    }

    public function add(Word $word): void
    {
        $this->words[] = $word;
    }

    public function count(): int
    {
        return count($this->words);
    }

    public function toArray(): array
    {
        return $this->words;
    }
}
