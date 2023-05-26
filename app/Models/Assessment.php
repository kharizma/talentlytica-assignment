<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    protected $table        = 'assessments';
    protected $keyType      = 'string';
    public $incrementing    = false;
    protected $guarded      = [];
}
