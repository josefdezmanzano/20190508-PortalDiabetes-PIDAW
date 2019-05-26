<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('glucose');
            $table->bigInteger('user_id')->unsigned();
            $table->string('momento');
            $table->bigInteger('longActingInsulin');
            $table->bigInteger('rapidActingInsulin');
            $table->string('rations');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medicions');
    }
}
