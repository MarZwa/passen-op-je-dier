<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'picture',
        'owner_id'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function request() {
        return $this->hasMany(Request::class);
    }
}