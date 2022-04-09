<?php


namespace LaravelEveTools\EveSeeder\Models\Sde;



use Illuminate\Database\Eloquent\Model;
use LaravelEveTools\EveSeeder\Traits\IsReadOnly;

class InvCategory extends AbstractSdeModel
{
    use IsReadOnly;


    /**
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var string
     */
    protected $table = 'invCategory';

    /**
     * @var string
     */
    protected $primaryKey = 'categoryID';

    /**
     * @var bool
     */
    public $timestamps = false;
}
