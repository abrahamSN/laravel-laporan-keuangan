<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pemasukan extends Model
{
    //menghubungkan tabel database
    protected $table = 'pemasukan';
    protected $primaryKey = 'id';
    protected $fillable = ['jasa_id', 'jumlah', 'keterangan', 'total', 'foto_bukti', 'tanggal'];
    public $timestamps = false;

    //menghubungkan table milik jasa
    public function jasa()
    {
        return $this->belongsTo('App\Jasa');
    }
}
