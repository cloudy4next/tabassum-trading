<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Retails extends Model
{
    use HasFactory;

    protected $guarded =['*'];

    protected $fillable = ['*'];

    public function sales()
    {
        return $this->belongsTo(Sales::class, 'retail_id', 'id');
    }
}
