<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;

class Client extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'slug',
        'phone',
        'company',
        'country',
        'about_me',
        'link',
        'avatar',
        'email',
        'password',
        'email_verified',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected static function booted()
    {
        static::creating(function (Client $client) {
            $client->slug = Str::slug($client->name);
        });
    }

    public function profile()
    {
        return $this->hasOne(ClientProfile::class )->withDefault([
            'phone'    => '-----',
            'company'  => '-----',
            'country'  => '-----',
            'about_me' => '-----',
            'link'     => '-----',
        ]);
    }



    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function getPictureClientAttribute()
    {
        if ($this->avatar == "dufault.png") {
            return asset('frontend/images/dufault.png');
        }
        return asset('storage/clients/' . $this->avatar);
    }
}
