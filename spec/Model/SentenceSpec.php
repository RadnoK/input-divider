<?php

declare(strict_types=1);

namespace spec\App\Model;

use App\Exception\InvalidSentenceValueException;
use PhpSpec\ObjectBehavior;

final class SentenceSpec extends ObjectBehavior
{
    function let(): void
    {
        $this->beConstructedWith('To be or not to be.');
    }

    function it_has_a_value(): void
    {
        $this->value()->shouldReturn('To be or not to be.');
    }

    function it_can_have_empty_string_as_a_value(): void
    {
        $this->beConstructedWith('');

        $this->shouldNotThrow(InvalidSentenceValueException::class);
    }

    function it_throws_an_exception_when_a_sentence_value_is_invalid(): void
    {
        $this->beConstructedWith('123 123.');
        $this->shouldThrow(InvalidSentenceValueException::class);

        $this->beConstructedWith('$%^^aasd asdasd.');
        $this->shouldThrow(InvalidSentenceValueException::class);
    }
}
