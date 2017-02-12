<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactMail;
use App\Models\Piyes\Inbox\ContactForm;
use App\Models\Piyes\Inbox\InboxMail;
use Mail;

class ContactController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function send(Request $request)
    {
        $form = ContactForm::findOrFail($request->form_id);
        Mail::to($form->to)->cc(($form->cc) ?: $form->to)->send(new ContactMail($request->name, $request->email, $request->phone, $request->subject, $request->body));
        InboxMail::create([
            'contact_form_id' => $form->id,
            'from' => $request->email,
            'to' => $form->to,
            'subject' => $request->subject,
            'body' => composeMailBody(['Phone' => $request->phone], $request->body)
        ]);
        session()->flash('success', 'Message sent.');
        return redirect()->back();
    }
}
