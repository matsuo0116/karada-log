<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    public function log() {
        return $this->belongsTo(Log::class);
    }
    public function type() {
        return $this->belongsTo(Type::class);
    }
}
