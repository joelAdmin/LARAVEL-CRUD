<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $table = 'empleados';
    protected $primaryKey = 'id';
    protected $fillable = ['nombre', 'email', 'sexo', 'boletin', 'descripcion', 'area_id'];
    protected $guarded = ['id'];

    public function role(){
        return $this->belongsToMany('App\Role', 'empleado_rol', 'empleado_id', 'rol_id');
    }

    public function area(){
        return $this->belongsTo('App\Area');
    }
}
