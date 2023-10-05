<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLicencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('licences', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tool_id')->index();
            $table->foreign('tool_id')->references('id')->on('tools')->onDelete('cascade');
            $table->string('description')->nullable();
            $table->unsignedMediumInteger('user_limit')->nullable();
            $table->unsignedDouble('annual_cost')->nullable();
            $table->unsignedDouble('cost_per_user')->nullable();
            $table->tinyText('currency')->nullable();
            $table->dateTime('start')->nullable();
            $table->dateTime('stop')->nullable();
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
        Schema::dropIfExists('licences');
    }
}
