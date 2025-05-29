<?php

namespace Purwantoid\LaravelPackage\Tests\TestPackage\Src\Commands;

use Illuminate\Console\Command;

class OptimizeCommand extends Command
{
    public $name = 'package-tools:optimize';

    public function handle(): void
    {
        $this->info('optimize package-tools');
    }
}
