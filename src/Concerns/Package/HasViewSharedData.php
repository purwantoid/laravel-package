<?php

declare(strict_types=1);

namespace Purwantoid\LaravelPackage\Concerns\Package;

trait HasViewSharedData
{
    public array $sharedViewData = [];

    public function sharesDataWithAllViews(string $name, $value): static
    {
        $this->sharedViewData[$name] = $value;

        return $this;
    }
}
