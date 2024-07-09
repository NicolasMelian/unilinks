<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appearance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'slug',
        'profile_image',
        'profile_title',
        'bio',
        'theme',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }


}
