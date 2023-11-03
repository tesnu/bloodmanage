<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Employee extends Authenticatable
{
    use Notifiable;
    protected $guard = 'employee';

    public function donations() : HasMany {
        return $this->hasMany(Donation::class);
    }
}
