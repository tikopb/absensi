<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShifthoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shifthours', function (Blueprint $table) {
            $table->bigIncrements('shifthours_id');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->string('value', 5);
            $table->string('nama', 100);
            $table->timestamp('in', 0);
            $table->timestamp('out', 0);
            $table->string('description', 10);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shifthours');
    }
}
