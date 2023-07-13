<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class DesignRequest extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'comments', 'reception_date', 'tentative_date', 'real_date', 'delivery_date',
        'customer_approved_date', 'estimated_arrival_sherpa_date',  'observations',
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
     * @var string[]
     */
    protected $with = [
        'priority', 'designer', 'seller', 'customer', 'time_state',
        'state', 'created_by', 'updated_by', 'tasks'
    ];

    /**
     * @return HasOne
     */
    public function priority(): HasOne
    {
        return $this->hasOne(DesignPriority::class, 'id', 'priority_id');
    }

    /**
     * @return HasOne
     */
    public function designer(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'designer_id');
    }

    /**
     * @return HasOne
     */
    public function seller(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'seller_id');
    }

    /**
     * @return HasOne
     */
    public function customer(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'customer_id');
    }

    /**
     * @return HasOne
     */
    public function time_state(): HasOne
    {
        return $this->hasOne(DesignTimeState::class, 'id', 'time_state_id');
    }

    /**
     * @return HasOne
     */
    public function state(): HasOne
    {
        return $this->hasOne(DesignState::class, 'id', 'state_id');
    }

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

    /**
     * @return HasMany
     */
    public function tasks(): HasMany
    {
        return $this->hasMany(DesignTask::class, 'design_request_id', 'id');
    }
}
