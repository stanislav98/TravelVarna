<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AllPenalties extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('all_penalties', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->foreignId('penalty_id');
            $table->decimal('amount', 8, 2);
            $table->string('violation',100);
            $table->string('violation_image_path',100);

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
