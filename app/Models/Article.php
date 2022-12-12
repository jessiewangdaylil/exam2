<?php

namespace App\Models;

use App\Models\Cgy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;

    public function cgy(){
        return $this->belongsTo(Cgy::class);
    }
}
