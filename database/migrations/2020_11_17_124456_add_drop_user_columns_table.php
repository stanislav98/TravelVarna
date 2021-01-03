<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDropUserColumnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'phone'))
            {
                $table->string('phone',100);
            }
           if (!Schema::hasColumn('users', 'type_id'))
            {
                $table->smallInteger('type_id');
            } 
            if (!Schema::hasColumn('users', 'egn'))
            {
                $table->string('egn',100);
            } 
            if (!Schema::hasColumn('users', 'qrcode_path'))
            {
                $table->string('qrcode_path',100);
            }
            if (!Schema::hasColumn('users', 'qr_active'))
            {
                $table->boolean('qr_active');
            }
        });

        //dropping columns 
         if (Schema::hasColumn('users', 'two_factor_recovery_codes'))
        {
            Schema::table('users', function (Blueprint $table)
            {
                $table->dropColumn('two_factor_recovery_codes');
            });
        } 
         if (Schema::hasColumn('users', 'two_factor_secret'))
        {
            Schema::table('users', function (Blueprint $table)
            {
                $table->dropColumn('two_factor_secret');
            });
        } 
        if (Schema::hasColumn('users', 'remember_token'))
        {
            Schema::table('users', function (Blueprint $table)
            {
                $table->dropColumn('remember_token');
            });
        } 
        if (Schema::hasColumn('users', 'current_team_id'))
        {
            Schema::table('users', function (Blueprint $table)
            {
                $table->dropColumn('current_team_id');
            });
        }
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
