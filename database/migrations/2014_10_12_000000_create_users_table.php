<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // create, create table: table name -> plural
        // table->blueprint method(), means type(column name)
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // primary key, bigint(20), auto increment -> no compound key -> 'id'
            $table->string('name'); // varchar(255)
            $table->string('email')->unique(); // unique key
            $table->timestamp('email_verified_at')->nullable(); // datetime, nullable
            $table->string('password'); // varchar(60), special for password
            $table->rememberToken(); // special method
            $table->timestamps(); // datetime, created_at, updated_at, special method
            $table->softDeletes();
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
