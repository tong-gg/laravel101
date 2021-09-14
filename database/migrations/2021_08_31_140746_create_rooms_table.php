<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(App\Models\Apartment::class); //, in case you don't know what table name is,
                                                                    // attach to your model by foreignIdFor()
            // $table->foreignId('apartment_id'); // naming convention table(singular_id)
            $table->string('name'); // room number
            $table->integer('floor'); // where this room is
            $table->enum('type', ['SUITE', 'STUDIO', 'LOFT', 'PENTHOUSE']);
            $table->timestamps();
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
        Schema::dropIfExists('rooms');
    }
}
