<?php

namespace Purwantoid\LaravelPackage\Tests\TestPackage\Src\Commands;

use Illuminate\Console\Command;

class ThirdTestCommand extends Command
{
    public $name = 'my-package:third-test-command';

    public function handle(): void
    {
        $this->info('output of third test command');
    }
}
