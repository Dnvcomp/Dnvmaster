<?php

namespace Dnvmaster;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    public function filter()
    {
        return $this->belongsTo('Dnvmaster\Filter','filter_alias','alias');
    }
}
