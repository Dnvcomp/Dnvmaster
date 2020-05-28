<?php

namespace Dnvmaster;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['title','img','alias','text','desc','keywords','meta_desc','category_id'];
    public function user()
    {
        return $this->belongsTo('Dnvmaster\User');
    }

    public function category()
    {
        return $this->belongsTo('Dnvmaster\Category');
    }

    public function comments()
    {
        return $this->hasMany('Dnvmaster\Comment');
    }
}
