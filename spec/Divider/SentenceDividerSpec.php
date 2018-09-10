<?php

declare(strict_types=1);

namespace spec\App\Divider;

use App\Divider\SentenceDividerInterface;
use App\Model\Collection\SentenceCollection;
use App\Model\Input;
use App\Model\Sentence;
use PhpSpec\ObjectBehavior;

final class SentenceDividerSpec extends ObjectBehavior
{
    function it_implements_sentence_divider_interface(): void
    {
        $this->shouldImplement(SentenceDividerInterface::class);
    }

    function it_divides_an_input_into_sentences(): void
    {
        $this->divide(new Input('This is the test sentence. And second quirk.'));

        $this->parts()->shouldBeLike(SentenceCollection::fromArray([
            new Sentence('This is the test sentence'),
            new Sentence('And second quirk'),
            new Sentence(''),
        ]));
    }
}
