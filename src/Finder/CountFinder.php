<?php

declare(strict_types=1);

namespace App\Finder;

use App\Model\Input;

interface CountFinder
{
    public function find(Input $input): void;

    public function result(): int;
}
