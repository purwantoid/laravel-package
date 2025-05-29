<?php

namespace Purwantoid\LaravelPackage\Tests\TestPackage\Src\Components;

use Closure;
use Illuminate\View\Component;

class TestComponent extends Component
{
    /**
     * Create the component instance.
     *
     * @return void
     */
    public function __construct(public string $message) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): Closure|string|\Illuminate\View\View
    {
        return '<div>' . $this->message . '</div>';
    }
}
