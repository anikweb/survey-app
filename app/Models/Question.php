<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    public function questionnaire(){
        return $this->belongsTo(Questionnaire::class,'questionnaire_id');
    }

    public function optionValue(){
        return $this->hasMany(questionniare_option::class,'question_id');
    }
}
