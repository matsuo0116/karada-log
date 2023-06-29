<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogTypes extends Model
{
    use HasFactory;

    protected $attributes = [
        'weight' => '0'
    ];

    public function log() {
        return $this->belongsTo(Log::class);
    }

    public function type() {
        return $this->belongsTo(Type::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
