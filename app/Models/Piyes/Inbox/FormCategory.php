<?php

namespace App\Models\Piyes\Inbox;

use App\Models\Piyes\BaseModel;
use App\Models\Piyes\Inbox\ContactForm;
use App\Models\Piyes\Inbox\InboxMail;

class FormCategory extends BaseModel
{
    protected $table = 'form_categories';
    protected $fillable = ['title', 'to', 'cc', 'contact_form_id', 'created_by', 'updated_by'];
    public static $rules = array(
        'contact_form_id' => 'required',
        'title' => 'required',
        'to' => 'required',
    );

    /**
     * A form category belongs to a contact form
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function form()
    {
        return $this->belongsTo(ContactForm::class, 'contact_form_id');
    }


    /**
     * A category may have many mails
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function mails()
    {
        return $this->hasOne(InboxMail::class, 'form_category_id');
    }

}