<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;

    protected $table = 'chapters';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $guarded = [];

    public function cover()
    {
        return $this->belongsTo('App\Models\Cover');
    }

    public function comment()
    {
        return $this->hasMany('App\Models\ChapterComment');
    }
}
