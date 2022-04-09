<?php

namespace LaravelEveTools\EveSeeder\Traits;

use LaravelEveTools\EveSeeder\Exceptions\ReadOnlyModelException;

trait IsReadOnly
{
/**
     * @var bool
     */
    protected static bool $bypass_read_only = false;

    /**
     * @param  array  $attributes
     * @return \Illuminate\Database\Eloquent\Model|$this
     *
     * @throws ReadOnlyModelException
     */
    public static function create(array $attributes = [])
    {
        if (self::$bypass_read_only)
            return parent::create($attributes);

        throw new ReadOnlyModelException;
    }

    /**
     * @param  array  $attributes
     * @param  array  $values
     * @return \Illuminate\Database\Eloquent\Model|static
     *
     * @throws ReadOnlyModelException
     */
    public static function firstOrCreate(array $attributes = [], array $values = [])
    {
        if (self::$bypass_read_only)
            return parent::firstOrCreate($attributes, $values);

        throw new ReadOnlyModelException;
    }

    /**
     * @param  array  $options
     *
     * @eturn bool
     *
     * @throws ReadOnlyModelException
     */
    public function save(array $options = [])
    {
        if (self::$bypass_read_only)
            return parent::save($options);

        throw new ReadOnlyModelException;
    }

    /**
     * @param  array  $attributes
     * @param  array  $options
     * @return bool
     *
     * @throws ReadOnlyModelException
     */
    public function update(array $attributes = [], array $options = [])
    {
        if (self::$bypass_read_only)
            return parent::update($attributes, $options);

        throw new ReadOnlyModelException;
    }

    /**
     * @return bool|null
     *
     * @throws ReadOnlyModelException
     */
    public function delete()
    {
        if (self::$bypass_read_only)
            return parent::delete();

        throw new ReadOnlyModelException;
    }

    /**
     * @return bool|null
     *
     * @throws ReadOnlyModelException
     */
    public function forceDelete()
    {
        if (self::$bypass_read_only)
            return parent::forceDelete();

        throw new ReadOnlyModelException;
    }

    /**
     * @param  bool  $new_value
     * @return $this
     */
    public function bypassReadOnly(bool $new_value = true)
    {
        self::$bypass_read_only = true;

        return $this;
    }
}
