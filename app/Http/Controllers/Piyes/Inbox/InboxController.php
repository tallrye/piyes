<?php

namespace App\Http\Controllers\Piyes\Inbox;

use Illuminate\Http\Request;
use App\Http\Controllers\Piyes\BaseController;
use App\Models\Piyes\Inbox\InboxMail;
use DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\SiteMail;

class InboxController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the Inbox
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        checkPermissionFor('manage_inbox');
        $mails = InboxMail::where('isTrash', false)->where('isSent', false)->where('isDraft', false)->orderBy('created_at', 'DESC')->paginate(10);
        $inboxName = "Inbox (".$mails->where('isRead', false)->count() .")";
        return view('piyes.inbox.index', compact('mails', 'inboxName'));
    }

    /**
     * Show the Sent Mails
     *
     * @return \Illuminate\Http\Response
     */
    public function sent()
    {
        checkPermissionFor('manage_inbox');
        $mails = InboxMail::where('isTrash', false)->where('isSent', true)->where('isDraft', false)->orderBy('created_at', 'DESC')->paginate(10);
        $inboxName = "Sent Mails";
        return view('piyes.inbox.index', compact('mails', 'inboxName'));
    }

    /**
     * Show the Important Mails
     *
     * @return \Illuminate\Http\Response
     */
    public function important()
    {
        checkPermissionFor('manage_inbox');
        $mails = InboxMail::where('isTrash', false)->where('isSent', false)->where('isImportant', true)->where('isDraft', false)->orderBy('created_at', 'DESC')->paginate(10);
        $inboxName = "Important Mails";
        return view('piyes.inbox.index', compact('mails', 'inboxName'));
    }

    /**
     * Show the Draft Mails
     *
     * @return \Illuminate\Http\Response
     */
    public function drafts()
    {
        checkPermissionFor('manage_inbox');
        $mails = InboxMail::where('isTrash', false)->where('isSent', false)->where('isDraft', true)->orderBy('created_at', 'DESC')->paginate(10);
        $inboxName = "Drafts";
        return view('piyes.inbox.index', compact('mails', 'inboxName'));
    }

    /**
     * Show the Trash
     *
     * @return \Illuminate\Http\Response
     */
    public function trash()
    {
        checkPermissionFor('manage_inbox');
        $mails = InboxMail::where('isTrash', true)->orderBy('created_at', 'DESC')->paginate(10);
        $inboxName = "Trash";
        $trashFolder = "";
        return view('piyes.inbox.index', compact('mails', 'inboxName', 'trashFolder'));
    }

    /**
     * Show a single mail detail
     *
     * @return \Illuminate\Http\Response
     */
    public function detail(InboxMail $mail)
    {
        checkPermissionFor('manage_inbox');
        $mail->isRead = true;
        $mail->save();
        return view('piyes.inbox.detail', compact('mail'));
    }

    /**
     * Edit a mail draft
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(InboxMail $mail)
    {
        checkPermissionFor('manage_inbox');
        return view('piyes.inbox.edit', compact('mail'));
    }

    /**
     * Compose new mail
     *
     * @return \Illuminate\Http\Response
     */
    public function compose()
    {
        checkPermissionFor('manage_inbox');
        return view('piyes.inbox.compose');
    }

    /**
     * Show reply page
     *
     * @return \Illuminate\Http\Response
     */
    public function reply(InboxMail $mail)
    {
        checkPermissionFor('manage_inbox');
        return view('piyes.inbox.reply', compact('mail'));
    }

    /**
     * Show search results
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        checkPermissionFor('manage_inbox');
        $mails = InboxMail::where('subject', 'LIKE', '%'.$request->subject.'%')->where('isTrash', false)->orderBy('created_at', 'DESC')->paginate(10);
        $inboxName = "Search Results For: '".$request->subject."'";
        return view('piyes.inbox.index', compact('mails', 'inboxName'));
    }


    /**
     * Send mail
     *
     * @return \Illuminate\Http\Response
     */
    public function send(Request $request)
    {
        checkPermissionFor('manage_inbox');
        Mail::to($request->to)->send(new SiteMail($request->from, $request->subject, $request->body));
        InboxMail::create([
            'from' => $request->from,
            'to' => $request->to,
            'subject' => $request->subject,
            'body' => composeMailBody($request->body),
            'isSent' => true,
            'isRead' => true
        ]);
        session()->flash('success', 'Mail sent');
        return redirect()->route('piyes.inbox.index');
    }

    /**
     * Save a composed mail as a draft
     *
     * @return \Illuminate\Http\Response
     */
    public function saveDraft(Request $request)
    {
        checkPermissionFor('manage_inbox');
        InboxMail::create([
            'from' => $request->from,
            'to' => ($request->to) ?: null,
            'subject' => ($request->subject) ?: null,
            'body' => composeMailBody($request->body),
            'isDraft' => true,
            'isRead' => true
        ]);
        session()->flash('success', 'Draft saved');
        return redirect()->route('piyes.inbox.drafts');
    }

    /**
     * Update existing draft
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InboxMail $mail)
    {
        checkPermissionFor('manage_inbox');
        $mail->update([
            'from' => $request->from,
            'to' => ($request->to) ?: null,
            'subject' => ($request->subject) ?: null,
            'body' => composeMailBody($request->body),
            'isDraft' => true,
            'isRead' => true
        ]);
        session()->flash('success', 'Draft updated');
        return redirect()->route('piyes.inbox.drafts');
    }

    /**
     * Mark selected mails as important
     *
     * @return \Illuminate\Http\Response
     */
    public function markAsImportant(Request $request)
    {
        checkPermissionFor('manage_inbox');
        foreach ($request->selected_mails as $id) {
            $mail = InboxMail::find($id);
            $mail->isImportant = true;
            $mail->save();
        }
        session()->flash('success', 'Selected mails marked as important');
        return redirect()->route('piyes.inbox.index');
    }

    /**
     * Mark selected mails as read
     *
     * @return \Illuminate\Http\Response
     */
    public function markAsRead(Request $request)
    {
        checkPermissionFor('manage_inbox');
        foreach ($request->selected_mails as $id) {
            $mail = InboxMail::find($id);
            $mail->isRead = true;
            $mail->save();
        }
        session()->flash('success', 'Selected mails marked as read');
        return redirect()->route('piyes.inbox.index');
    }

    /**
     * Move selected mails as to trash
     *
     * @return \Illuminate\Http\Response
     */
    public function markAsTrash(Request $request)
    {
        checkPermissionFor('manage_inbox');
        foreach ($request->selected_mails as $id) {
            $mail = InboxMail::find($id);
            $mail->isTrash = true;
            $mail->save();
        }
        session()->flash('success', 'Selected mails moved to trash');
        return redirect()->route('piyes.inbox.index');
    }

    /**
     * Move selected mail to trash
     *
     * @return \Illuminate\Http\Response
     */
    public function moveToTrash(Request $request, InboxMail $mail)
    {
        checkPermissionFor('manage_inbox');
        $mail->isTrash = true;
        $mail->save();
        session()->flash('success', 'Mail has moved to trash');
        return redirect()->route('piyes.inbox.index');
    }
 
}