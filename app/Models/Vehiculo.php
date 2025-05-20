<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Usuario; // ✅ Importar el modelo relacionado

class Vehiculo extends Model
{
    use HasFactory;

    protected $table = 'vehiculos';

    protected $fillable = [
        'placa',
        'marca',
        'modelo',
        'color',
        'tipo',
        'usuario_id',
    ];

    // Relación con Usuario
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    // Relación con Servicios
    public function servicios()
    {
        return $this->hasMany(Servicio::class, 'vehiculo_id');
    }

    // Relación con Alertas
    public function alertas()
    {
        return $this->hasMany(Alerta::class, 'vehiculo_id');
    }
}
