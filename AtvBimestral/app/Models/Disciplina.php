<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Disciplina extends Model {

    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['nome', 'curso_id', 'carga'];

    public function curso(){
        return $this->belongsTo('App\Models\Curso');
    }

    public function professor(){
        return $this->belongsTo('App\Models\Professores');
    }

    public function aluno(){
        return $this->hasMany('App\Models\Aluno');
    }

    public function vinculo(){
        return $this->hasMany('App\Models\Vinculo');
    }
}