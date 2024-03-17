<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'date',
        'id_category',
        'image'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'id_category');
    }
}
