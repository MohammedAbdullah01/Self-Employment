<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;

    protected $fillable = ['name' , 'slug' ,'description' , 'parent_id', 'img' ];

    public function getPictureCategoryAttribute()
    {
        return asset('storage/categories/' . $this->img);
    }

    public function subCategory()
    {
        return $this->hasMany(Categorie::class,'parent_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(Categorie::class,'parent_id', 'id')
            ->withDefault([
                'name' => 'No Parent'
            ]);
    }

    public function projects()
    {
        return $this->hasMany(Project::class , 'category_id' ,'id');
    }


    public function latestWorks()
    {
        return $this->hasMany(Latestwork::class);
    }
}
