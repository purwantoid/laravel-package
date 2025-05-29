<?php

namespace Purwantoid\LaravelPackage\Tests\TestPackage\Src\Commands;

use Illuminate\Console\Command;

class FourthTestCommand extends Command
{
    public $name = 'my-package:fourth-test-command';

    public function handle(): void
    {
        $this->info('output of fourth test command');
    }
}
