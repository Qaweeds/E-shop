<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = ['rating'];

    public function rateable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        $userClassName = config('auth.providers.user.model');

        return $this->belongsTo($userClassName);
    }
}
