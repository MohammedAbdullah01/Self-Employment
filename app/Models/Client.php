<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Client extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
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

    public function client()
    {
        return $this->hasOne(Client::class)->withDefault([
            'phone'    => 'Empty',
            'company'  => 'Empty',
            'country'  => 'Empty',
            'about_me' => 'Empty',
            'link'     => 'Empty',
        ]);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function getPictureClientAttribute()
    {
        if ($this->avatar == "dufault.png") {
            return asset('frontend/assets/img/dufault.png');
        }
        return asset('storage/clients/' . $this->avatar);
    }
}
