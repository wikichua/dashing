<?php

namespace Wikichua\Dashing\Models;

class Mailer extends \Spatie\MailTemplates\Models\MailTemplate
{
    use \Illuminate\Database\Eloquent\SoftDeletes;
    use \Wikichua\Dashing\Http\Traits\AllModelTraits;

    protected $table = 'mail_templates';
    protected $menu_icon = 'fas fa-mail-bulk';
    protected $need_audit = true;
    protected $snapshot = true;

    protected $dates = ['deleted_at'];
    protected $fillable = [
        'mailable',
        'subject',
        'html_template',
        'text_template',
        'created_by',
        'updated_by',
        'brand_id',
    ];

    protected $appends = [
        'readUrl',
    ];

    protected $searchableFields = ['subject'];

    protected $casts = [
    ];

    public function scopeFilterSubject($query, $search)
    {
        return $query->where('subject', 'like', "%{$search}%");
    }

    public function getReadUrlAttribute($value)
    {
        return $this->readUrl = isset($this->id) ? route('mailer.show', $this->id):'';
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
