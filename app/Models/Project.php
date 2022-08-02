<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'client_id', 'category_id', 'description','activate' , 'status', 'skills', 'budget', 'type', 'delivery_period'];



    const TYPE_50_25     = '$50-25';
    const TYPE_100_50    = '$100-50';
    const TYPE_250_100   = '$250-100';
    const TYPE_500_250   = '$500-250';
    const TYPE_1000_500  = '$1000-500';
    const TYPE_2500_1000 = '$2500-1000';
    const TYPE_5000_2500 = '$5000-2500';

    public static function budgets()
    {
        return [
            self::TYPE_50_25     => '$50-25',
            self::TYPE_100_50    => '$100-50',
            self::TYPE_250_100   => '$250-100',
            self::TYPE_500_250   => '$500-250',
            self::TYPE_1000_500  => '$1000-500',
            self::TYPE_2500_1000 => '$2500-1000',
            self::TYPE_5000_2500 => '$5000-2500',

        ];
    }

    const TYPE_FIXED  = 'fixed';
    const TYPE_HOURLY = 'hourly';

    public static function types()
    {
        return [
            self::TYPE_FIXED  => 'fixed',
            self::TYPE_HOURLY => 'hourly',
        ];
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }

    public function category()
    {
        return $this->belongsTo(Categorie::class)
            ->withDefault([
                'name' => 'No Catrgory'
            ]);
    }

    public function tags()
    {
        return $this->belongsToMany(
            Tag::class,
            'project_tag',
            'project_id',
            'tag_id',
            'id',
            'id',
        );
    }

    public function syncTags(array $tags)
    {
        $tags_id = [];
        foreach ($tags as $tag_name) {
            $tag = Tag::firstOrCreate(
                [
                    'slug' => Str::slug($tag_name)
                ],
                [
                    'name' => $tag_name
                ]
            );
            $tags_id[] = $tag->id;
        }
        $this->tags()->sync($tags_id);
    }

    public function getstatusProjectAttribute()
    {
        if ($this->status == 'open') {

            return 'text-right  badge bg-success';
        } elseif ($this->status == 'closed') {
            return 'text-right text-dark  badge bg-danger';
        } elseif ($this->status == 'in-progress') {
            return 'text-right badge bg-info';
        }
    }
    public function getskillsProjectAttribute()
    {
        if ($this->skills) {

            $skills = Str::upper($this->skills);

            return explode(',', $skills) ;

        }
    }

    public function getdeliveryPeriodProjectAttribute()
    { 
        $delivery_period = $this->delivery_period;

        if ($delivery_period) {

            return $delivery_period . '/Days' ;

        }
        return 'Empty';
    }


}
