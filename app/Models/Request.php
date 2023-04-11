<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_date',
        'end_date',
        'rate',
        'pet_id'
    ];

    public function pet() {
        return $this->belongsTo(Pet::class);
    }

    public function sitter() {
        return $this->hasOne(User::class, 'id', 'sitter_id');
    }

    public function registrations() {
        return $this->hasMany(Registration::class);
    }
}
