<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'id', 'parent_id', 'name', 'cost',
    ];

    private $dynamic = [];

    public function getId()
    {
        return $this->id;
    }

    public function getCost()
    {
        return $this->cost;
    }

    public function getName()
    {
        $key = 'name';

        if (!isset($this->dynamic[$key]))
        {
            $name = $this->name;

            if ($this->parent_id)
            {
                $parent_name = $this->getParent()->getName();
                $name = $parent_name . ' ' . $name;
            }

            $this->dynamic[$key] = $name;
        }

        return (string)$this->dynamic[$key];
    }

    public function getParent()
    {
        $key = 'parent';
        if (!isset($this->dynamic[$key]))
        {
            $this->dynamic[$key] = Product::where('id', $this->parent_id)->first();
        }

        return $this->dynamic[$key];
    }

    public function scopeNotParent($query)
    {
        return $query->where('parent_id', null);
    }

}
