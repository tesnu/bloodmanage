<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;
    public function hospital() : BelongsTo {
        return $this->belongsTo(Hospital::class);
    }
    public function donation() : BelongsTo {
        return $this->belongsTo(Donation::class);
    }
}
