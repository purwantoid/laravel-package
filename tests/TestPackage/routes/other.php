<?php

use Illuminate\Support\Facades\Route;

Route::get('other-route', static fn (): string => 'other response');
