<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Pagina
 *
 * @property $id
 * @property $text
 * @property $numeracion
 * @property $cuento_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Cuento $cuento
 * @property Ilustracion[] $ilustracions
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Pagina extends Model
{
    
    static $rules = [
		'text' => 'required',
		'numeracion' => 'required',
		'cuento_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['text','numeracion','cuento_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function cuento()
    {
        return $this->hasOne('App\Models\Cuento', 'id', 'cuento_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ilustracions()
    {
        return $this->hasMany('App\Models\Ilustracion', 'pagina_id', 'id');
    }
    

}
