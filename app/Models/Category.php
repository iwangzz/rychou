<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

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