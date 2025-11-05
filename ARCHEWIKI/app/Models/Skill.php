<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $table = 'skills'; // ajuste se sua tabela tem outro nome
    protected $fillable = [
        'nome',
        'descricao',
        'imagem'
    ];
}
