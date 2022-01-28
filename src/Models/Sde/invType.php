<?php


namespace LaravelEveTools\EveSeeder\Models\Sde;


use Illuminate\Database\Eloquent\Model;
use LaravelEveTools\EveSeeder\Traits\IsReadOnly;

class invType extends AbstractSdeModel
{
    use IsReadOnly;

        /**
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var string
     */
    protected $table = 'invTypes';

    /**
     * @var string
     */
    protected $primaryKey = 'typeID';

    /**
     * @var bool
     */
    public $timestamps = false;


    public function getTypeIdAttribute(): int{
        return $this->typeID;
    }

    public function getGroupIdAttribute(): int{
        return $this->groupID;
    }

    public function getTypeNameAttribute(): string{
        return $this->typeName;
    }



}
