<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Requestinterview extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'requestinterviews';

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
    protected $fillable = ['subject', 'user_id', 'is_approved', 'details'];

    public function users()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
