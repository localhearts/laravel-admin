<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('task_id');
            $table->longText('description');
            $table->string('capture');
            $table->timestamps();
            $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');

        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reports');
    }
}
