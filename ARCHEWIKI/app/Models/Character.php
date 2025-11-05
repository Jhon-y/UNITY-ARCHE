<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    protected $primaryKey = 'idP';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'characterName',
        'ancestry',
        'type',
        'life',
        'imagem',
    ];
}
