<?php


namespace LaravelEveTools\EveSeeder\Models\Sde;


use Illuminate\Database\Eloquent\Model;
use LaravelEveTools\EveSeeder\Traits\IsReadOnly;


abstract class AbstractSdeModel extends Model
{
    use IsReadOnly;


    /**
     * @var bool
     */
    public $incrementing = false;

    public $timestamps = false;

}
