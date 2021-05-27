<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('adverts', function (Blueprint $table): void {
            $table->id();
            $table->string('marketplace_key', 40)->index();
            $table->string('title', 500);
            $table->string('url', 1000)->nullable();
            $table->unsignedDouble('price', 10, 2)->index();
            $table->timestamps();

            $table->foreign('marketplace_key')->references('key')->on('marketplaces');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('adverts');
    }
}
