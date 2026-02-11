<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    protected $guarded = [];
    use HasFactory;

    public function transaction(){
        return $this->belongsToMany(Transaction::class, 'product_transaction');
    }
}
