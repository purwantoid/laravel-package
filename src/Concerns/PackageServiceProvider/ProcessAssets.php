<?php

declare(strict_types=1);

namespace Purwantoid\LaravelPackage\Concerns\PackageServiceProvider;

trait ProcessAssets
{
    protected function bootPackageAssets(): static
    {
        if (! $this->package->hasAssets || ! $this->app->runningInConsole()) {
            return $this;
        }

        $vendorAssets = $this->package->basePath('/../resources/dist');
        $appAssets = public_path("vendor/{$this->package->shortName()}");

        $this->publishes([$vendorAssets => $appAssets], "{$this->package->shortName()}-assets");

        return $this;
    }
}
