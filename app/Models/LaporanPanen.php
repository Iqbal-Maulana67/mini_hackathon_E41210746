<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanPanen extends Model
{
    protected $table = "laporan_panen";
    protected $primaryKey = "id_laporan";
    protected $fillable = ["id_laporan", "nama_tanaman", "berat_panen", "tahun_panen", "kondisi_tanaman"];    
}
