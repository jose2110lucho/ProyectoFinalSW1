<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Cuento
 *
 * @property $id
 * @property $fecha
 * @property $titulo
 * @property $genero_id
 * @property $user_id
 * @property $tipo_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Elemento[] $elementos
 * @property Genero $genero
 * @property Pagina[] $paginas
 * @property Tipo $tipo
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Cuento extends Model
{
    
    static $rules = [
		'created_at' => 'required',
		'titulo' => 'required',
		'genero_id' => 'required',
		'user_id' => 'required',
		'tipo_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['created_at','titulo','genero_id','user_id','tipo_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function elementos()
    {
        return $this->hasMany('App\Models\Elemento', 'cuento_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function genero()
    {
        return $this->hasOne('App\Models\Genero', 'id', 'genero_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function paginas()
    {
        return $this->hasMany('App\Models\Pagina', 'cuento_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function tipo()
    {
        return $this->hasOne('App\Models\Tipo', 'id', 'tipo_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
    

}
