<?php

declare(strict_types=1);

namespace Purwantoid\LaravelPackage\Concerns\PackageServiceProvider;

trait ProcessCommands
{
    protected function bootPackageCommands(): self
    {
        if (empty($this->package->commands)) {
            return $this;
        }

        $this->commands($this->package->commands);

        return $this;
    }

    protected function bootPackageConsoleCommands(): self
    {
        if (empty($this->package->consoleCommands) || ! $this->app->runningInConsole()) {
            return $this;
        }

        $this->commands($this->package->consoleCommands);

        return $this;
    }
}
