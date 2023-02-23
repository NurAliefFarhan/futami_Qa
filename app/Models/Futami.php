<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Futami extends Model
{
    use HasFactory;
    protected $fillable = [
        'nodokumen',
        'pemberi_sampel',
        'parameter_pengujian',
        'jumlah_sampel',
        'tanggal_terima',
        'tanggal_uji',
        'tanggal_selesai',
        'statusOP',
        'statusST',
        'statusSP',
        'user_id_OP',
        'user_id_ST',
        'user_id_SP',
        'name_id_OP',
        'name_id_ST',
        'name_id_SP',
        'created_at_OP',
        'created_at_ST',
        'created_at_SP',
        'delete',
        'done_time',
        'user_id',
    ];

    public function futami_sampel_kimia()
    {
        return $this->hasMany(Futami_sampel_kimia::class, 'id_analisa_kimia');
    }
}

