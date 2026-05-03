<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetallePedido extends Model
{
    protected $table = 'detalles_pedido';
    
    protected $fillable = [
        'pedido_id',
        'producto_id',
        'producto_nombre',
        'producto_precio',
        'cantidad',
        'subtotal'
    ];

    protected $casts = [
        'producto_precio' => 'decimal:2',
        'subtotal' => 'decimal:2'
    ];

    public function pedido(): BelongsTo
    {
        return $this->belongsTo(Pedido::class);
    }

    public function producto(): BelongsTo
    {
        return $this->belongsTo(Producto::class);
    }
}