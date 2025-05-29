<?php

namespace Purwantoid\LaravelPackage\Tests\TestPackage\database\migrations;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('laravel-package-tools_table-explicit-normal', function (Blueprint $table): void {
            $table->bigIncrements('id');

            $table->timestamps();
        });
    }
};
