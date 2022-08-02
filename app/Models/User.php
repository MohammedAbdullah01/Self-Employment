<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;



    const GANDER_MALE   = 'male';
    const GANDER_FEMALE = 'female';

    public function ganders()
    {
        return [
            self::GANDER_MALE   => 'male',
            self::GANDER_FEMALE => 'female',
        ];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'avatar',
        'password',
        'email_verified',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function profile()
    {
        return $this->hasOne(Freelancer::class)->withDefault([
            'title_job'   => 'Empty',
            'skills'      => 'Empty',
            'gander'      => 'Empty',
            'country'     => 'Empty',
            'hourly_rate' => 'Empty',
            'phone'       => 'Empty',
            'github'      => 'Empty',
            'twitter'     => 'Empty',
            'linkedin'    => 'Empty',
            'hourlyRates' => 'Empty',
            'country'     => 'Empty',
        ]);
    }


    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function commendProjects()
    {
        return $this->belongsToMany(
            Project::class,
            'comments',
            'user_id',
            'project_id',
            'id',
            'id'
        )->withPivot([
            'id',
            'comment',
            'created_at',
        ]);
    }

    public function contractedProjects()
    {
        return $this->belongsToMany(
            Project::class,
            'contracts',
            'user_id',
            'project_id',
            'id',
            'id'
        )->withPivot([
            'comment_id',
            'cost',
            'type',
            'status',
            'hours',
            'start_on',
            'end_on'
        ]);
    }

    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }

    public function latestwork()
    {
        return $this->hasMany(Latestwork::class);
    }

    public function getPictureFreelancerAttribute()
    {
        if ($this->avatar == "dufault.png") {
            return asset('frontend/assets/img/dufault.png');
        }
        return asset('storage/users/' . $this->avatar);
    }
}
