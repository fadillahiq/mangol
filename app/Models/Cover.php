<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cover extends Model
{
    use HasFactory;

    protected $table = 'covers';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $guarded = [];


    public function genres()
    {
        return $this->belongsToMany('App\Models\Genre');
    }

    public function chapters()
    {
        return $this->hasMany('App\Models\Chapter');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }
}
