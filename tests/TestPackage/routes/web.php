<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::get('my-route', static fn (): string => 'my response');

Route::get('execute-command', static function () {
    Artisan::call('package-tools:test-command');

    return Artisan::output();
});
