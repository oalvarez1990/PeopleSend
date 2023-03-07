<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peoplesend extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_number',
        'names',
        'last_names',
        'email',
        'country',
        'address',
        'phone', 
        'id_categorie',  
 
    ];

    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }
}
