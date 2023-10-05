<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLicenceIdToBusinessCaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_cases', function (Blueprint $table) {
            $table->unsignedBigInteger('licence_id')->nullable()->after('tool_id');
            $table->foreign('licence_id')->references('id')->on('licences')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('business_cases', function (Blueprint $table) {
            $table->removeColumn('licence_id');
        });
    }
}
