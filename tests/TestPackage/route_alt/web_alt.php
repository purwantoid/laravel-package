<?php

use Illuminate\Support\Facades\Route;

Route::get('my-route-alt', static fn (): string => 'my response');
