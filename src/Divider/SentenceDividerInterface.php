<?php

declare(strict_types=1);

namespace App\Divider;

use App\Model\Collection\SentenceCollection;
use App\Model\Input;

interface SentenceDividerInterface
{
    public function divide(Input $input): void;

    public function parts(): SentenceCollection;
}
