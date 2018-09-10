<?php

declare(strict_types=1);

namespace spec\App\Divider;

use App\Divider\WordDividerInterface;
use App\Model\Collection\WordCollection;
use App\Model\Sentence;
use App\Model\Word;
use PhpSpec\ObjectBehavior;

final class WordDividerSpec extends ObjectBehavior
{
    function it_implements_word_divider_interface(): void
    {
        $this->shouldImplement(WordDividerInterface::class);
    }

    function it_divides_a_sentence_into_words(): void
    {
        $this->divide(new Sentence('This is the test sentence.'));

        $this->parts()->shouldBeLike(WordCollection::fromArray([
            new Word('This'),
            new Word('is'),
            new Word('the'),
            new Word('test'),
            new Word('sentence'),
        ]));
    }
}
