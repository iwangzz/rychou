<?php

namespace App\Models;

use Encore\Admin\Traits\AdminBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes, AdminBuilder;

    protected $table = 'posts';

    protected $casts = [
        'extra' => 'json',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable', 'demo_taggables');
    }

    public function comments()
    {
        return $this->hasMany(PostComments::class);
    }

    public function getContentAttribute($content)
    {
        return json_decode($content, true);
    }

    public function setContentAttribute($content)
    {
        $this->attributes['content'] = json_encode($content);
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {

            if ($model->author_id == 0) {
                $model->author_id = null;
            }

        });
    }
}