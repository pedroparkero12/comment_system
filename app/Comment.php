<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['post_id','parent_id','name','content'];

    public function setNameAttribute($value){
        $this->attributes['name'] = title_case($value);
    }

    public function getCreatedAtAttribute($value)
    {
        return date('m/d/Y h:i:s A',strtotime($value));
    }
}



