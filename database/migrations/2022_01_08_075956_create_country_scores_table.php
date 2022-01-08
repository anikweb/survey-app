<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountryScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('country_scores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('country_id');
            $table->integer('questionnaire_id');
            $table->bigInteger('total_perticipants');
            $table->bigInteger('total_score');
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
        Schema::dropIfExists('country_scores');
    }
}
