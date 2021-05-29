<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProxyColumnToMarketplacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('marketplaces', function (Blueprint $table): void {
            $table->boolean('proxy')->default(false)->after('title');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('marketplaces', function (Blueprint $table) : void{
            $table->dropColumn('proxy');
        });
    }
}
