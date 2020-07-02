<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActiveShiftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('active_shifts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('shift_id');
            $table->unsignedBigInteger('location_id');
            $table->string('name');
            $table->dateTime('date');
            $table->string('from');
            $table->string('until');
            $table->tinyInteger('confirmed_steward');
            $table->tinyInteger('confirmed_supervisor');
            $table->text('comments')->nullable();
            $table->float('duration')->nullable();
            $table->float('factor')->nullable();
            $table->tinyInteger('is_holiday');
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
        Schema::dropIfExists('active_shifts');
    }
}
