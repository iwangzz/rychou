<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $table = 'regions';

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