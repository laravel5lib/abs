<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteAvailabilityHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('histories', function (Blueprint $table) {
            $table->dropColumn('availability');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('histories', function (Blueprint $table) {
            $table->string('availability')->nullable()->after('rank');
        });
    }
}
