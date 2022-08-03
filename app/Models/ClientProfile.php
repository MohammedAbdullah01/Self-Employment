<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientProfile extends Model
{
    use HasFactory;

    public $table = "client_profils";
    protected $fillable = ['client_id' , 'company',	'phone',	'country',	'link',	'about_me'];


    public function client()
    {
        return $this->belongsTo(Client::class );
    }
}
