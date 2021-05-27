<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCrawlerProxiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('crawler_proxies', function (Blueprint $table) : void{
            $table->id();
            $table->string('username', 80);
            $table->string('password', 80);
            $table->string('ip', 32);
            $table->string('port', 8);
            $table->date('expired_at')->index();
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
        Schema::dropIfExists('crawler_proxies');
    }
}
