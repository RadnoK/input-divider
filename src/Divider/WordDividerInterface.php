<?php

declare(strict_types=1);

namespace App\Divider;

use App\Model\Collection\WordCollection;
use App\Model\Sentence;

interface WordDividerInterface
{
    public function divide(Sentence $sentence): void;

    public function parts(): WordCollection;
}
