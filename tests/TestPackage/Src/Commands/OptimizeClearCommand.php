<?php

namespace Purwantoid\LaravelPackage\Tests\TestPackage\Src\Commands;

use Illuminate\Console\Command;

class OptimizeClearCommand extends Command
{
    public $name = 'package-tools:clear-optimizations';

    public function handle(): void
    {
        $this->info('optimize clear package-tools');
    }
}
