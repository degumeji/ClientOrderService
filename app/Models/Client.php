<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $fillable = ['firstName', 'lastName', 'email', 'phone'];

    // Un cliente tiene muchos pedidos
    public function orders() {
        return $this->hasMany(Order::class);
    }
}
