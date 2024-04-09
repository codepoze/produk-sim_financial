<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    // untuk default tabel
    protected $table = 'categories';
    // untuk default primary key
    protected $primaryKey = 'id_category';
    // untuk tabel yang bisa di isi
    protected $fillable = [
        'id_category',
        'name',
        'by_users',
    ];
}
