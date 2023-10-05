<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventTypeTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_type_tags', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('icon')->comment('Accepts the path tag of an SVG')->nullable();
            $table->unsignedBigInteger('event_type_id')->index();
            $table->foreign('event_type_id')->references('id')->on('event_types')->onDelete('cascade');
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
        Schema::dropIfExists('event_type_tags');
    }
}
