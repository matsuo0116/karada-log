<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Type extends Model
{
    use HasFactory;

    public function logs(): BelongsToMany
    {
        return $this->belongsToMany(Log::class);
    }
    public function parts()
    {
        return $this->belongsTo(Part::class);
    }
    public function exercises(){
        return $this->hasMany(Exercise::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
}
