<?php

declare(strict_types=1);

namespace Purwantoid\LaravelPackage\Concerns\Package;

use Purwantoid\LaravelPackage\Commands\InstallCommand;

trait HasInstallCommand
{
    public function hasInstallCommand($callable): static
    {
        $installCommand = new InstallCommand($this);

        $callable($installCommand);

        $this->consoleCommands[] = $installCommand;

        return $this;
    }
}
