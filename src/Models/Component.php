<?php

namespace Wikichua\Dashing\Models;

use Illuminate\Database\Eloquent\Model;

class Component extends Model
{
    use \Illuminate\Database\Eloquent\SoftDeletes;
    use \Wikichua\Dashing\Http\Traits\AllModelTraits;

    protected $need_audit = true;
    protected $snapshot = true;
    protected $menu_icon = 'fas fa-cube';

    protected $dates = ['deleted_at'];
    protected $fillable = [
        'created_by',
        'updated_by',
        'name',
        'brand_id',
    ];

    protected $appends = [
        'readUrl',
        'brand_name',
    ];

    protected $searchableFields = ['name'];

    protected $casts = [
    ];

    public function scopeFilterName($query, $search)
    {
        return $query->where('name', 'like', "%{$search}%");
    }

    public function scopeBrandId($query, $search)
    {
        return $query->where('brand_id', $search);
    }

    public function getReadUrlAttribute($value)
    {
        return $this->readUrl = isset($this->id) ? route('brand.show', $this->id):'';
    }

    public function getBrandNameAttribute($value)
    {
        return $this->brand_name = $this->brand ? strtolower($this->brand->name) : 'System';
    }

    public function brand()
    {
        return $this->belongsTo(config('dashing.Models.Brand'), 'brand_id', 'id');
    }
}
