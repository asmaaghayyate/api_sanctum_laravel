<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poste extends Model
{
    use HasFactory;

    protected $fillable = ['body', 'id_user','id_categorie'];


    public function user()
    {  
        return $this->belongsTo(User::class , 'id_user');
    }
      
}
