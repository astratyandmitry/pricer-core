<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnToAdvertUpdatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('advert_updates', function (Blueprint $table): void {
            $table->boolean('new')->default(false)->after('price_diff');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('advert_updates', function (Blueprint $table): void {
            $table->dropColumn('new');
        });
    }
}
