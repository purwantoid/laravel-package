<?php

namespace Purwantoid\LaravelPackage\Tests\TestPackage\Src\Commands;

use Illuminate\Console\Command;

class TestCommand extends Command
{
    public $name = 'package-tools:test-command';

    public function handle(): void
    {
        $this->info('output of test command');
    }
}
