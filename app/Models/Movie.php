<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;
    protected $fillable = ['title','release_year','director_name','actor_id'];

    public function actor(){
        return $this->hasOne(Actor::class,'id','actor_id');
    }

}
