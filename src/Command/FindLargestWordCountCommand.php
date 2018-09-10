<?php

declare(strict_types=1);

namespace App\Command;

use App\Divider\SentenceDivider;
use App\Divider\SentenceDividerInterface;
use App\Divider\WordDivider;
use App\Divider\WordDividerInterface;
use App\Finder\LargestWordCountFinder;
use App\Model\Input;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Stopwatch\Stopwatch;

final class FindLargestWordCountCommand extends Command
{
    private const COMMAND_ID = 'app-find-largest-word-count';

    /** @var SymfonyStyle */
    private $io;

    /** @var SentenceDividerInterface */
    private $sentenceDivider;

    /** @var WordDividerInterface */
    private $wordDivider;

    public function __construct()
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setName('app:find:largest-word-count')
            ->setDescription('Find largest word count in given input')
            ->addArgument('input', InputArgument::REQUIRED)
        ;
    }

    protected function initialize(InputInterface $input, OutputInterface $output): void
    {
        $this->io = new SymfonyStyle($input, $output);
        $this->sentenceDivider = new SentenceDivider();
        $this->wordDivider = new SentenceDivider();
    }

    protected function execute(InputInterface $input, OutputInterface $output): void
    {
        $stopwatch = new Stopwatch();
        $stopwatch->start(self::COMMAND_ID);

        $largestWordCount = 0;

        $inputString = $input->getArgument('input');

        try {
            $input = new Input($inputString);

            $wordDivider = new WordDivider();
            $sentenceDivider = new SentenceDivider();

            $largestWordCountFinder = new LargestWordCountFinder($sentenceDivider, $wordDivider);
            $largestWordCountFinder->find($input);

            $largestWordCount = $largestWordCountFinder->result();

            $this->io->success(sprintf(
                'Largest word count in given sentence(s) is: %d',
                $largestWordCount
            ));
        } catch (\Exception $exception) {
            $this->io->error('Something went wrong :(');
        }

        $event = $stopwatch->stop(self::COMMAND_ID);

        if ($output->isVerbose()) {
            $this->io->comment(sprintf(
                'Created supplier with ID: %s / Elapsed time: %.2f ms / Consumed memory: %.2f MB',
                $largestWordCount,
                $event->getDuration(),
                $event->getMemory() / (1024 ** 2)
            ));
        }
    }

}
