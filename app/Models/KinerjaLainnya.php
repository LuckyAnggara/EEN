<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class KinerjaLainnya extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'kinerja_lainnya';
    protected $guarded = [
        'id',
    ];
    public $primaryKey = 'id';
    public $timestamps = true;
    protected $dates = ['created_at','deleted_at','tanggal_surat_perintah'];

}
