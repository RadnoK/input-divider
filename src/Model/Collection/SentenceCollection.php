<?php

declare(strict_types=1);

namespace App\Model\Collection;

use App\Model\Sentence;

final class SentenceCollection
{
    /** @var array */
    private $sentences = [];

    private function __construct(array $sentences = [])
    {
        $this->sentences = $sentences;
    }

    public static function createEmpty(): self
    {
        return new self();
    }

    public static function fromArray(array $sentences): self
    {
        $sentenceCollection = self::createEmpty();

        foreach ($sentences as $sentence) {
            $sentenceCollection->add($sentence);
        }

        return $sentenceCollection;
    }

    public function add(Sentence $sentence): void
    {
        $this->sentences[] = $sentence;
    }

    public function count(): int
    {
        return count($this->sentences);
    }

    public function toArray(): array
    {
        return $this->sentences;
    }
}
