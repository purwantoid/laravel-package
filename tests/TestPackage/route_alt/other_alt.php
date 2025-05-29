<?php

use Illuminate\Support\Facades\Route;

Route::get('other-route-alt', static fn (): string => 'other response');
