<?php

declare(strict_types=1);

namespace Purwantoid\LaravelPackage\Commands\Concerns;

trait AskToStarRepoOnGitHub
{
    protected ?string $starRepo = null;

    public function askToStarRepoOnGitHub(?string $vendorSlashRepoName): self
    {
        $this->starRepo = $vendorSlashRepoName;

        return $this;
    }

    protected function processStarRepo(): self
    {
        if ($this->starRepo && $this->confirm('Would you like to star our repo on GitHub?')) {
            $repoUrl = "https://github.com/{$this->starRepo}";

            if (PHP_OS_FAMILY === 'Darwin') {
                exec("open {$repoUrl}");
            }
            if (PHP_OS_FAMILY === 'Windows') {
                exec("start {$repoUrl}");
            }
            if (PHP_OS_FAMILY === 'Linux') {
                exec("xdg-open {$repoUrl}");
            }
        }

        return $this;
    }
}
