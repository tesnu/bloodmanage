<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Hospital extends Authenticatable
{
    use Notifiable;
    protected $guard = 'hospital';
    public function orders() : HasMany {
        return $this->hasMany(Order::class);
    }
}
