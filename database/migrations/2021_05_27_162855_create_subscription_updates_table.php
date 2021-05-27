<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionUpdatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('subscription_updates', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('subscription_id')->constrained('subscriptions');
            $table->unsignedInteger('adverts');
            $table->unsignedInteger('adverts_prev');
            $table->integer('adverts_diff');
            $table->unsignedDouble('price_min', 10, 2);
            $table->unsignedDouble('price_min_prev', 10, 2);
            $table->double('price_min_diff', 10, 2);
            $table->unsignedDouble('price_max', 10, 2);
            $table->unsignedDouble('price_max_prev', 10, 2);
            $table->double('price_max_diff', 10, 2);
            $table->unsignedDouble('price_avg', 10, 2);
            $table->unsignedDouble('price_avg_prev', 10, 2);
            $table->double('price_avg_diff', 10, 2);
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
        Schema::dropIfExists('subscription_updates');
    }
}
