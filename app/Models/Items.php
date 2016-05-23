<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    protected $table = 'items';
    public $timestamps = true;
    protected $guarded = ['id'];

    protected $casts = [
        'attributes' => 'array',
        'prices' => 'array',
        'tool' => 'array',
        'capabilities' => 'array'
    ];

    protected $appends = ['type'];

    public function getTypeAttribute(){
        return $this->item_type_name;
    }
}
