<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'prix',
        'details',
        'image',
        'categorie',
        'user_id'
    ];

    protected $casts = [
        'prix' => 'decimal:2'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Accesseur pour formater le prix
    public function getPrixFormateAttribute()
    {
        return number_format($this->prix, 0, ',', ' ') . ' FCFA';
    }
}