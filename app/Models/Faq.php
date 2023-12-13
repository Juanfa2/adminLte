<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'faqs';
    protected $fillable = ['Sector','Numero','Pregunta','Respuesta'];
}
