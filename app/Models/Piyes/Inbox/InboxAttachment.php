<?php

namespace App\Models\Piyes\Inbox;

use App\Models\Piyes\BaseModel;
use App\Models\Piyes\Inbox\InboxMail;

class InboxAttachment extends BaseModel
{
    protected $table = 'inbox_attachments';
    protected $fillable = ['inbox_mail_id', 'path', 'created_by', 'updated_by'];
    public static $rules = array(
        'inbox_mail_id' => 'required',
        'path' => 'required',
    );

    /**
     * An attachment belongs to a mail
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function mail()
    {
        return $this->belongsTo(InboxMail::class, 'inbox_mail_id');
    }
}