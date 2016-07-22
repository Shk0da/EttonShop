<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $updated_at = false;

    protected $fillable = [
        'user_id', 'product_id', 'count', 'created_at'
    ];

    private $dynamic = [];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function getDate()
    {
        return $this->created_at;
    }

    public function getData()
    {
        $key = 'data';
        if (!isset($this->dynamic[$key])) {
            $this->dynamic[$key] = json_decode($this->data);
        }

        return (array)$this->dynamic[$key];
    }

    public function getSum()
    {
        $sum = 0;
        $items = $this->getData();

        foreach ($items as $item) {
            $sum += ($item->cost * $item->count);
        }

        return round($sum, 2);
    }

}
