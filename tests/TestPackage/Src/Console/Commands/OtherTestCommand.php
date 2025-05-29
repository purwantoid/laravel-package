<?php

namespace Purwantoid\LaravelPackage\Tests\TestPackage\Src\Console\Commands;

use Illuminate\Console\Command;

class OtherTestCommand extends Command
{
    public $name = 'package-tools:other-test-command';

    public function handle(): void
    {
        $this->info('output of other test command');
    }
}
