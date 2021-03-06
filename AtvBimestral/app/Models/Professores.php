<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Professores extends Model {

    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['nome', 'email', 'siape', 'eixo_id', 'ativo'];
}