<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'review',
        'rating',
        'owner_id',
        'sitter_id'
    ];

    public function owner() {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function sitter() {
        return $this->belongsTo(User::class, 'sitter_id');
    }
}
