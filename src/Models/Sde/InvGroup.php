<?php


namespace LaravelEveTools\EveSeeder\Models\Sde;


use Illuminate\Database\Eloquent\Model;
use LaravelEveTools\EveSeeder\Traits\IsReadOnly;

class InvGroup extends AbstractSdeModel
{
    use IsReadOnly;


    /**
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var string
     */
    protected $table = 'invGroups';

    /**
     * @var string
     */
    protected $primaryKey = 'groupID';

    /**
     * @var bool
     */
    public $timestamps = false;
}
