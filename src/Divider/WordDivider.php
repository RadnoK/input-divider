<?php

declare(strict_types=1);

namespace App\Divider;

use App\Exception\InvalidWordValueException;
use App\Model\Collection\WordCollection;
use App\Model\Sentence;
use App\Model\Word;
use phpDocumentor\Reflection\DocBlock\Tags\Param;

final class WordDivider implements WordDividerInterface
{
    /** @var string  */
    private static $divisionCharacter = ' ';

    /** @var array */
    private $parts = [];

    public function divide(Sentence $sentence): void
    {
        $this->parts = preg_split(sprintf('/[%s]/', self::$divisionCharacter), (string) $sentence);
    }

    public function parts(): WordCollection
    {
        $parts = WordCollection::createEmpty();

        foreach ($this->parts as $part) {
            $this->addPart($parts, $part);
        }

        return $parts;
    }

    private function addPart(WordCollection $words, string $word): void
    {
        try {
            $newWord = new Word($word);

            $words->add($newWord);
        } catch (InvalidWordValueException $exception) {
        }
    }
}
