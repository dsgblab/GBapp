<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class DesignRequest extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'priority_id', 'designer_id', 'seller_id', 'customer_id', 'comments', 'reception_date', 'tentative_date',
        'real_date', 'delivery_date', 'customer_approved_date', 'estimated_arrival_sherpa_date', 'time_state_id',
        'state_id', 'observations', 'created_id', 'updated_id'
    ];

    /**
     * @var string[]
     */
    protected $hidden = [
        'priority_id', 'designer_id', 'seller_id', 'customer_id',
        'time_state_id', 'state_id', 'created_id', 'updated_id'
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'created_at' => 'datetime:Y-m-d h:i:s A',
        'updated_at' => 'datetime:Y-m-d h:i:s A',
        'reception_date' => 'datetime:Y-m-d h:i:s A',
        'real_date' => 'datetime:Y-m-d h:i:s A',
        'delivery_date' => 'datetime:Y-m-d h:i:s A',
        'customer_approved_date' => 'datetime:Y-m-d h:i:s A',
        'estimated_date_arrival_sherpa_date' => 'datetime:Y-m-d h:i:s A',
    ];

    /**
     * @return HasOne
     */
    public function created_by(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'created_id');
    }

    /**
     * @return HasOne
     */
    public function updated_by(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'updated_id');
    }
}
