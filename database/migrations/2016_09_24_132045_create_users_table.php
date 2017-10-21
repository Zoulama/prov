<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('users');
        Schema::create('users', function($table)
        {
            $table->increments('id');
            $table->unsignedInteger('account_id')->index();
            $table->timestamps();
            $table->softDeletes();

            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('username')->unique();
            $table->string('num_orias')->nullable();
            $table->string('raison_sociale')->nullable();
            $table->string('user_key')->unique();
            $table->unsignedInteger('country_id')->nullable();
            $table->string('email')->nullable();
            $table->string('password');
            $table->string('confirmation_code')->nullable();
            $table->boolean('registered')->default(false);
            $table->boolean('confirmed')->default(false);
            $table->boolean('notify_sent')->default(true);
            $table->boolean('notify_viewed')->default(false);
            $table->boolean('notify_paid')->default(true);
            $table->text('private_notes')->nullable();
            $table->timestamp('last_login')->nullable();
            $table->boolean('is_deleted')->default(false);
            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade');
            $table->unsignedInteger('public_id')->nullable();
            $table->unique(array('account_id','public_id') );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
