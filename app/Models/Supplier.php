<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    /** @use HasFactory<\Database\Factories\SupplierFactory> */
    use HasFactory;

    protected $fillable = [
        "first_name",
        "last_name",
        "email",
        "phone_number"
    ];

    public function products () {
        return $this->hasMany(Product::class);
    }
}
