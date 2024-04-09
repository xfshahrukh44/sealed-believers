<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faith extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'faiths';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'short_desc', 'description', 'image', 'user_id'];

    public function users()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

}
