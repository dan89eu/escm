<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
	        $table->string("status")->after("notes")->nullable();
	        $table->string("quantity")->after("notes")->nullable();
	        $table->string("quality_indicators")->after("notes")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
	        $table->dropColumn(array('status','quantity','quality_indicators'));
        });
    }
}
