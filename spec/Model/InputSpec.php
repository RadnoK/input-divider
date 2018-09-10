<?php

declare(strict_types=1);

namespace spec\App\Model;

use App\Exception\InvalidInputValueException;
use PhpSpec\ObjectBehavior;

final class InputSpec extends ObjectBehavior
{
    function let(): void
    {
        $this->beConstructedWith('Input sentences. More sentences.');
    }

    function it_has_a_value(): void
    {
        $this->value()->shouldReturn('Input sentences. More sentences.');
    }

    function it_throws_an_exception_when_its_value_has_invalid_length(): void
    {
        $this->beConstructedWith('');
        $this->shouldThrow(InvalidInputValueException::class);

        $this->beConstructedWith('This is an invalid string given as a value of this input. And today, I am gonna show you all of its quirks and exceptions');
        $this->shouldThrow(InvalidInputValueException::class);
    }
}
