<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'project_id',
        'comment_id',
        'cost',
        'type',
        'status',
        'hours',
        'start_on',
        'end_on'
    ];

    protected $casts = [
        'start_on' => 'datetime',
        'end_on'   => 'datetime'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }
}
