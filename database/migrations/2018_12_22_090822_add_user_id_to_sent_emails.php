<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use jdavidbakr\MailTracker\Model\SentEmail;

class AddUserIdToSentEmails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sent_emails', function (Blueprint $table) {
            $table->integer('user_id');
            $table->string('message_id')->nullable();
            $table->text('meta')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sent_emails', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
        Schema::connection((new SentEmail())->getConnectionName())->table('sent_emails', function (Blueprint $table) {
            $table->dropColumn('message_id');
        });
        Schema::connection((new SentEmail())->getConnectionName())->table('sent_emails', function (Blueprint $table) {
            $table->dropColumn('meta');
        });
    }
}
