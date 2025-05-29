<?php

namespace Purwantoid\LaravelPackage\Tests\TestPackage\database\migrations_alt;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class create_table_alt_explicit_normal extends Migration
{
    public function up(): void
    {
        Schema::create('laravel-package-tools_table-subfolder-explicit-normal', function (Blueprint $table): void {
            $table->bigIncrements('id');

            $table->timestamps();
        });
    }
}
