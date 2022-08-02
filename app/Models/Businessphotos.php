<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Businessphotos extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable =
    [
        'latestwork_id', 'sub_images'
    ];


    public function latestWork()
    {
        return $this->belongsTo(Latestwork::class,'latestwork_id' , 'id');
    }

    public function getpicturesLatestWorksAttribute()
    {
        return asset('storage/users/latestwork/' . $this->sub_images);
    }
}

