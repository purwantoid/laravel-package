<?php

declare(strict_types=1);

namespace Purwantoid\LaravelPackage\Concerns\Package;

trait HasAssets
{
    public bool $hasAssets = false;

    public function hasAssets(): static
    {
        $this->hasAssets = true;

        return $this;
    }
}
