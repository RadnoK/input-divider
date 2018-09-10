<?php

declare(strict_types=1);

namespace spec\App\Model;

use App\Exception\InvalidWordValueException;
use PhpSpec\ObjectBehavior;

final class WordSpec extends ObjectBehavior
{
    function let(): void
    {
        $this->beConstructedWith('Circumstances');
    }

    function it_has_a_value(): void
    {
        $this->value()->shouldReturn('Circumstances');
    }

    function it_throws_an_exception_when_word_is_invalid(): void
    {
        $this->beConstructedWith('a');

        $this->shouldThrow(InvalidWordValueException::class);
    }
}
