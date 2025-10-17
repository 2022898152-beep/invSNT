<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class HardwareType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'icon',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($hardwareType) {
            if (empty($hardwareType->slug)) {
                $hardwareType->slug = Str::slug($hardwareType->name);
            }
        });

        static::updating(function ($hardwareType) {
            if ($hardwareType->isDirty('name') && empty($hardwareType->slug)) {
                $hardwareType->slug = Str::slug($hardwareType->name);
            }
        });
    }

    public function hardware()
    {
        return $this->hasMany(Hardware::class, 'type_id');
    }
}
