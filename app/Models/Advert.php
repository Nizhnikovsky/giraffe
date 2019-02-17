<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Advert extends Model
{
    protected $table = 'adverts';
    public $timestamps = false;

    protected $fillable = [
        'title',
        'photo',
        'description',
        'created_at',
    ];


    public function users()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

}
