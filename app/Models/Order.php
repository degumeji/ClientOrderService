<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['client_id', 'orderDate', 'total', 'status'];

    // Un pedido pertenece a un cliente
    public function client() {
        return $this->belongsTo(Client::class);
    }
}
