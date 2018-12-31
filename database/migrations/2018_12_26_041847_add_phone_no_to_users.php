<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPhoneNoToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('phoneNo')->nullable();
            $table->integer('type2FA')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            Schema::connection((new Users())->getConnectionName())->table('users', function (Blueprint $table) {
                $table->dropColumn('phoneNo');
            });
            Schema::connection((new Users())->getConnectionName())->table('users', function (Blueprint $table) {
                $table->dropColumn('type2FA');
            });
        });
    }
}
