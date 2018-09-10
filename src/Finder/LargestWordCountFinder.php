<?php

declare(strict_types=1);

namespace App\Finder;

use App\Divider\SentenceDividerInterface;
use App\Divider\WordDividerInterface;
use App\Model\Input;
use App\Model\Sentence;

final class LargestWordCountFinder implements CountFinder
{
    /** @var SentenceDividerInterface */
    private $sentenceDivider;

    /** @var WordDividerInterface */
    private $wordDivider;

    /** @var int */
    private $result = 0;

    public function __construct(SentenceDividerInterface $sentenceDivider, WordDividerInterface $wordDivider)
    {
        $this->sentenceDivider = $sentenceDivider;
        $this->wordDivider = $wordDivider;
    }

    public function find(Input $input): void
    {
        $this->divideAndCalculate($input);
    }

    public function result(): int
    {
        return $this->result;
    }

    private function divideAndCalculate(Input $input): void
    {
        $this->sentenceDivider->divide($input);

        $sentenceParts = $this->sentenceDivider->parts();

        /** @var Sentence $sentencePart */
        foreach ($sentenceParts->toArray() as $sentencePart) {
            $this->wordDivider->divide($sentencePart);

            $wordParts = $this->wordDivider->parts();

            if ($this->result < $sentenceWordCount = $wordParts->count()) {
                $this->result = $sentenceWordCount;
            }
        }
    }
}
