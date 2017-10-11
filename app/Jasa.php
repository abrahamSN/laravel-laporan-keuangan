<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jasa extends Model
{
    //menghubungkan tabel database
    protected $table = 'jasa';
    protected $primaryKey = 'id';
    protected $fillable = ['nama_jasa', 'keterangan', 'harga_jasa'];
    public $timestamps = false;

    //membuat hubungan satu ke banyak
    public function pemasukan()
    {
        return $this->hasMany('App\Pemasukan');
    }
}
