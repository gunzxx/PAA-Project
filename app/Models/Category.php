<?php

namespace App\Models;

use App\Models\Tourist;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function tourist()
    {
        return $this->hasMany(Tourist::class);
    }
}
