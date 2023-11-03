<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Donation extends Model
{
    use HasFactory;
    public function donor() : BelongsTo {
        return $this->belongsTo(Donor::class);
    }
    public function employee() : BelongsTo {
        return $this->belongsTo(Employee::class);
    }
    public function order() : HasOne {
        return $this->hasOne(Order::class);
    }
}
