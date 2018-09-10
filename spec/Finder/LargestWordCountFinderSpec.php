<?php

declare(strict_types=1);

namespace spec\App\Finder;

use App\Divider\SentenceDividerInterface;
use App\Divider\WordDividerInterface;
use App\Finder\CountFinder;
use App\Model\Collection\SentenceCollection;
use App\Model\Collection\WordCollection;
use App\Model\Input;
use App\Model\Sentence;
use App\Model\Word;
use PhpSpec\ObjectBehavior;

final class LargestWordCountFinderSpec extends ObjectBehavior
{
    function let(SentenceDividerInterface $sentenceDivider, WordDividerInterface $wordDivider): void
    {
        $this->beConstructedWith($sentenceDivider, $wordDivider);
    }

    function it_implements_count_finder_interface(): void
    {
        $this->shouldImplement(CountFinder::class);
    }

    function it_finds_largest_word_count_for_a_given_input(
        SentenceDividerInterface $sentenceDivider,
        WordDividerInterface $wordDivider
    ): void {
        $sentences = SentenceCollection::createEmpty();
        $sentences->add(new Sentence('Test input'));

        $sentenceDivider->divide(new Input('Test input.'))->shouldBeCalled();
        $sentenceDivider->parts()->willReturn($sentences);

        $words = WordCollection::createEmpty();
        $words->add(new Word('Test'));
        $words->add(new Word('input'));

        $wordDivider->divide(new Sentence('Test input'))->shouldBeCalled();
        $wordDivider->parts()->willReturn($words);

        $this->find(new Input('Test input.'));
    }
}
