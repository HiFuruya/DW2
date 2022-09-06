<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Professores extends Model {

    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['nome', 'email', 'siape', 'eixo_id', 'ativo'];

    public function eixo(){
        return $this->belongsTo('App\Models\Eixo');
    }

    public function disciplina(){
        return $this->hasMany('App\Models\Disciplina');
    }

    public function vinculo(){
        return $this->hasMany('App\Models\Vinculo');
    }
}