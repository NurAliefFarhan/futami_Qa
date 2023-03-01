<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mikrobiologi_air extends Model
{
    use HasFactory;
    protected $guarded = [
        'id',
    ];

    public function sampel_mikrobiologi_air()
    {
        return $this->hasMany(Sampel_mikrobiologi_air::class, 'id_mikrobiologi');
    }
}
