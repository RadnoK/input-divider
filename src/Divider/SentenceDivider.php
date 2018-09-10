<?php

declare(strict_types=1);

namespace App\Divider;

use App\Exception\InvalidSentenceValueException;
use App\Model\Collection\SentenceCollection;
use App\Model\Input;
use App\Model\Sentence;

final class SentenceDivider implements SentenceDividerInterface
{
    /** @var array */
    private static $divisionCharacters = ['.', '?', '!'];

    /** @var array */
    private $parts = [];

    public function divide(Input $input): void
    {
        $sentences = preg_split(sprintf('/[%s]/', $this->divisionCharacters()), (string) $input);

        $this->parts = $sentences;
    }

    public function parts(): SentenceCollection
    {
        $parts = SentenceCollection::createEmpty();

        foreach ($this->parts as $part) {
            $this->addPart($parts, $part);
        }

        return $parts;
    }

    private function addPart(SentenceCollection $sentences, string $sentence): void
    {
        try {
            $newSentence = new Sentence($sentence);

            $sentences->add($newSentence);
        } catch (InvalidSentenceValueException $exception) {
        }
    }

    private function divisionCharacters(): string
    {
        return implode('', self::$divisionCharacters);
    }
}
