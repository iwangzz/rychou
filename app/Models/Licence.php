<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Licence extends Model
{
    protected $table = 'licences';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'qq',
        'wechat',
        'price',
        'region',
        'company',
        'equity_ratio',
        'valid_date',
        'category',
        'img',
        'collection',
        'message',
        'status'
    ];

    public $timestamps = false;

    // public function setOptionsAttribute($options)
    // {
    //     if (is_array($options)) {
    //         $this->attributes['options'] = implode(',', $options);
    //     }
    // }

    // public function getOptionsAttribute($options)
    // {
    //     if (is_string($options)) {
    //         return explode(',', $options);
    //     }

    //     return $options;
    // }
}