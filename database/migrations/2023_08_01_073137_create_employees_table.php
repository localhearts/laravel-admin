<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements("id")->unique()->autoIncrement(false);
            $table->string('fullname', 50);
            $table->string('company', 50);
            $table->string('position', 50);
            $table->string('phone', 12);
            $table->string('bankaccount', 50);
            $table->string('npwp',50);
            $table->string('bpjskesehatan',50);
            $table->string('bpjsketenagakerjaan',50);
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
        Schema::dropIfExists('employees');
    }
};
