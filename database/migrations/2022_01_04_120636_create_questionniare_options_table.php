<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionniareOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questionniare_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('question_id');
            $table->string('option1');
            $table->integer('point1');
            $table->string('option2');
            $table->integer('point2');
            $table->string('option3');
            $table->integer('point3');
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
        Schema::dropIfExists('questionniare_options');
    }
}
