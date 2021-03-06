<?php

namespace Wikichua\Dashing\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use \Illuminate\Database\Eloquent\SoftDeletes;
    use \Wikichua\Dashing\Http\Traits\AllModelTraits;

    protected $need_audit = true;
    protected $snapshot = true;
    protected $menu_icon = 'fas fa-file-contract';

    protected $dates = ['deleted_at'];
    protected $fillable = [
        'created_by',
        'updated_by',
        'name',
        'queries',
        'status',
        'cache_ttl',
        'generated_at',
        'next_generate_at',
        'brand_id',
    ];

    protected $appends = [
        'status_name',
    ];

    protected $searchableFields = [];

    protected $casts = [
        'queries' => 'array',
    ];

    public function getStatusNameAttribute($value)
    {
        return settings('report_status')[$this->attributes['status']];
    }

    public function scopeFilterName($query, $search)
    {
        return $query->where('name', 'like', "%{$search}%");
    }

    public function scopeFilterStatus($query, $search)
    {
        return $query->whereIn('status', $search);
    }

    public function getGeneratedAtAttribute($value)
    {
        return $this->inUserTimezone($value);
    }

    public function getNextGenerateAtAttribute($value)
    {
        return $this->inUserTimezone($value);
    }

    public function brand()
    {
        return $this->belongsTo(config('dashing.Models.Brand'))->withDefault(['name' => null]);
    }

    public function setBrandIdAttribute($value)
    {
        return $this->brand_id = $value == '' ? 0: $value;
    }
}
