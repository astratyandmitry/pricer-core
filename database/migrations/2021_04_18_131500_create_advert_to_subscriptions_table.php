<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertToSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('advert_to_subscriptions', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('advert_id')->constrained('adverts');
            $table->foreignId('subscription_id')->constrained('subscriptions');
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
        Schema::dropIfExists('advert_to_subscriptions');
    }
}
