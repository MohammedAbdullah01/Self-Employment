<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Freelancer extends Model
{
    protected $fillable =
    [
        'user_id',    'gander',  'phone',    'title_job',  'country',  'verified',
        'hourly_rate',   'about_me', 'skills', 'twitter', 'github', 'linkedin',
    ];

    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function gethourlyRatesAttribute()
    {
        $hourly = $this->hourly_rate;
        if ($hourly) {
            return '$ ' . $hourly;
        }
    }
}
