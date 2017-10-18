<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProjectsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->integer('initialCost')->nullable();
            $table->integer('finalCost')->nullable();
            $table->date('contracting_date')->nullable();
            $table->date('eta_delivery_date')->nullable();
            $table->date('final_delivery_date')->nullable();
            $table->text('gps_location')->nullable();
            $table->text('details')->nullable();
            $table->text('notes')->nullable();
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
        Schema::drop('projects');
    }
}
