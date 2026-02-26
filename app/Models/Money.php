<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Money extends Model
{
    use HasFactory;

    protected $table = 'money';
    
    protected $primaryKey = 'id_money';
    
    protected $fillable = [
        'id_users',
        'id_category',
        'name',
        'amount',
        'description',
        'date',
    ];

    protected  $with = ['toCategory'];

    public function toCategory()
    {
        return $this->belongsTo(Category::class, 'id_category', 'id_category');
    }
}
