<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jesusreturn extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'jesusreturns';

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
    protected $fillable = ['title', 'video', 'video_iframe'];

    
}
