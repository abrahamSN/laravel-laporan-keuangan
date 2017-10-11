<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    //menghubungkan tabel database
    protected $table = 'pengeluaran';
    protected $primaryKey = 'id';
    protected $fillable = ['nama', 'jumlah', 'keterangan', 'total', 'foto_bukti', 'tanggal'];
    public $timestamps = false;
}
