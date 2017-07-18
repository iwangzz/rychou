<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserMessage extends Model
{
    protected $table = 'user_messages';

    protected $fillable = [
        'name',
        'phone',
        'email',
        'qq',
        'licence_id',
        'licence_category',
        'region',
        'price',
        'message',
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