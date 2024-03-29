<?php

namespace App\Models\Admin\User;

use Illuminate\Database\Eloquent\Model;

class Geolocation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Get the table associated with the model.
     */
    public function getTable(): string
    {
        return 'users_geolocation_history';
    }
}
