<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{

    public $timestamps = false;
    protected $fillable = ['name','slug'];
    use HasFactory;


    public function projects()
    {
        return $this->belongsToMany(
            Tag::class,
            'project_tag',
            'tag_id',
            'project_id',
            'id',
            'id',
        );
    }
}
