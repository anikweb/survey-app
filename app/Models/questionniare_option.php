<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class questionniare_option extends Model
{
    use HasFactory;

    public function questionnaireValue(){
        return $this->belongsTo(Question::class,'question_id');
    }
}
