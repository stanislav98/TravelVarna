<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SiteInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('site_info', function (Blueprint $table) {
            $table->id();
            $table->string('site_name',100);
            $table->string('site_email',100);
            $table->string('site_phone',100);
            $table->string('firm_name',100);
            $table->string('address',100);
            $table->string('gps',100);
            $table->string('station_email',100);
            $table->string('gps_coords',100);
            $table->string('info_name',100);
            $table->string('info_phone',100);
            $table->string('info_email',100);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
