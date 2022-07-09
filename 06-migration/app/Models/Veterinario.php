<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Veterinario extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['crmv', 'nome', 'especialidade_id'];

    public function especialidade(){
        return $this->belongsTo('App/Models/Especialidade');
    }
}
