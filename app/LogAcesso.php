<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogAcesso extends Model
{
    protected $fillable = ['log']; //coluna 'log' poderá ser preenchida de modo massivo.
}