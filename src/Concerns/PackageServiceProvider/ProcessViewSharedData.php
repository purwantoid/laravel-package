<?php

declare(strict_types=1);

namespace Purwantoid\LaravelPackage\Concerns\PackageServiceProvider;

use Illuminate\Support\Facades\View;

trait ProcessViewSharedData
{
    protected function bootPackageViewSharedData(): self
    {
        if (empty($this->package->sharedViewData)) {
            return $this;
        }

        foreach ($this->package->sharedViewData as $name => $value) {
            View::share($name, $value);
        }

        return $this;
    }
}
