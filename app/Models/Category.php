<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\RingTone;

class Category extends Model
{
    use HasFactory;

    public function ringtone()
    {
       return $this->hasMany(RingTone::class);
    }
}
