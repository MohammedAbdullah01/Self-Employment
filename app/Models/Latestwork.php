<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Latestwork extends Model
{

    protected $fillable =
    [
        'user_id', 'title', 'main_photo', 'description'
    ];
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function photos()
    {
        return $this->hasMany(Businessphotos::class, 'latestwork_id', 'id');
    }

    public function getpictureLatestWorksAttribute()
    {
        if ($this->main_photo  == "dufault.png") {

            return asset('frontend/assets/img/dufault.png');
        }
        return asset('storage/users/latestwork/' . $this->main_photo);
    }
}
