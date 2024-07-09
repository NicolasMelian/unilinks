<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Model\User;

class Link extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'user_id',
        'name',
        'url',
        'image'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
