<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TypeDocumentIdentification extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name'
    ];

    /**
     * @var string[]
     */
    protected $hidden = [
        'created_id', 'updated_id'
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'created_at' => 'datetime:Y-m-d h:i:s A',
        'updated_at' => 'datetime:Y-m-d h:i:s A'
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
