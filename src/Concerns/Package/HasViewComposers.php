<?php

declare(strict_types=1);

namespace Purwantoid\LaravelPackage\Concerns\Package;

trait HasViewComposers
{
    public array $viewComposers = [];

    public function hasViewComposer($view, $viewComposer): static
    {
        if (! is_array($view)) {
            $view = [$view];
        }

        foreach ($view as $viewName) {
            $this->viewComposers[$viewName] = $viewComposer;
        }

        return $this;
    }
}
