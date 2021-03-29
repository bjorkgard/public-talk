<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCountryToChairmen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('chairmen', function (Blueprint $table) {
            $table->string('phone_country')
                    ->after('phone')
                    ->default('SE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('chairmen', function (Blueprint $table) {
            $table->dropColumn('phone_country');
        });
    }
}
