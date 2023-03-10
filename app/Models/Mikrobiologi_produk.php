<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mikrobiologi_produk extends Model
{
    use HasFactory;
    protected $guarded = [
        'id',
    ];

    public function sampel_mikrobiologi_produk()
    {
        return $this->hasMany(Sampel_mikrobiologi_produk::class, 'id_produk');
    }
    
}
