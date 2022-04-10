<?php

namespace LaravelEveTools\EveSeeder\Models;

use Illuminate\Database\Eloquent\Model;

class SdeSettings extends Model
{

    protected $table = 'sde_settings';

    protected $casts = [
        'sde' => 'array'
    ];

}