<?php

declare(strict_types=1);

namespace Purwantoid\LaravelPackage\Commands;

use Illuminate\Console\Command;
use Purwantoid\LaravelPackage\Commands\Concerns\AskToRunMigrations;
use Purwantoid\LaravelPackage\Commands\Concerns\AskToStarRepoOnGitHub;
use Purwantoid\LaravelPackage\Commands\Concerns\PublishesResources;
use Purwantoid\LaravelPackage\Commands\Concerns\SupportsServiceProviderInApp;
use Purwantoid\LaravelPackage\Commands\Concerns\SupportsStartWithEndWith;
use Purwantoid\LaravelPackage\Package;

final class InstallCommand extends Command
{
    use AskToRunMigrations;
    use AskToStarRepoOnGitHub;
    use PublishesResources;
    use SupportsServiceProviderInApp;
    use SupportsStartWithEndWith;

    protected Package $package;

    public function __construct(Package $package)
    {
        $this->signature = $package->shortName() . ':install';

        $this->description = 'Install ' . $package->name;

        $this->package = $package;

        $this->hidden = true;

        parent::__construct();
    }

    public function handle(): void
    {
        $this
            ->processStartWith()
            ->processPublishes()
            ->processAskToRunMigrations()
            ->processCopyServiceProviderInApp()
            ->processStarRepo()
            ->processEndWith();

        $this->info("{$this->package->shortName()} has been installed!");
    }
}
