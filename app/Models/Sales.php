<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    use HasFactory;

    protected $table = 'sales';


    protected $guarded =[];
    protected $fillable = ['*'];

    public function getTotalSaleAmount()
    {
        // Calculate the total sale amount, including the upfront payment
        $productCost = $this->product->cost_price;
        $totalSaleAmount = ($this->quantity_sold * $this->product->selling_price) + $this->upfront_payment;

        return $totalSaleAmount - ($this->quantity_sold * $productCost);
    }

   public function product()
   {
       return $this->HasMany(Product::class,'id','product_id'  );
   }

    public function retails()
    {
        return $this->HasMany(Retails::class,'id','retail_id'  );
    }
}
