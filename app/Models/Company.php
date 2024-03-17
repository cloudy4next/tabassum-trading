<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $table = 'company';
    protected $guarded =[''];
    protected $fillable = ['*'];


    public function product()
    {
        return $this->HasMany(Product::class,'product_id','id' );
    }

    public function sales()
    {
        return $this->HasMany(Sales::class,'company_id',  'id');
    }


}
