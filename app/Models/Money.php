<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Money extends Model
{
    use HasFactory;
    // untuk default tabel
    protected $table = 'money';
    // untuk default primary key
    protected $primaryKey = 'id_money';
    // untuk tabel yang bisa di isi
    protected $fillable = [
        'id_money',
        'id_category',
        'name',
        'status',
        'amount',
        'description',
        'date',
        'by_users',
    ];

    // untuk relasi
    protected  $with = ['toCategory'];

    // untuk relasi ke tabel category
    public function toCategory()
    {
        return $this->belongsTo(Category::class, 'id_category', 'id_category');
    }
}
