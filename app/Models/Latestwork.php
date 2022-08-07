<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Latestwork extends Model
{

    use HasFactory;
    protected $fillable =
    [
        'user_id', 'title', 'category_id' ,'main_photo', 'description'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function photos()
    {
        return $this->hasMany(Businessphotos::class, 'latestwork_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Categorie::class);
    }

    public function getpictureLatestWorksAttribute()
    {
        if ($this->main_photo  == "dufault.png") {

            return asset('frontend/assets/img/dufault.png');
        }
        return asset('storage/users/latestwork/' . $this->main_photo);
    }
}
