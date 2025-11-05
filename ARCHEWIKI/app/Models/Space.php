<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Space extends Model
{
    protected $primaryKey = 'idSpace';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'spaceName',
        'location',
        'description',
        'imagem',
    ];
}
