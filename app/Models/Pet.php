<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'kind',
        'description',
        'picture',
        'owner_id'
    ];

    public function owner() {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function requests() {
        return $this->hasMany(Request::class);
    }
}
