<?php

namespace App\Models;

use App\Models\User;
use App\Models\Tourist;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function tourist()
    {
        return $this->belongsTo(Tourist::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
