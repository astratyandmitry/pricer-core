<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertUpdatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('advert_updates', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('advert_id')->constrained('adverts');
            $table->unsignedDouble('price', 10, 2)->index();
            $table->unsignedDouble('price_prev', 10, 2)->index();
            $table->double('price_diff', 10, 2)->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('advert_updates');
    }
}
