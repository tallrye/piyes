<?php

use App\Models\Piyes\User\Invitee;
use App\Models\Piyes\Inbox\InboxMail;
use App\Models\Piyes\Inbox\ContactForm;
use Carbon\Carbon;
use App\Models\Piyes\Loginlog;

/* Get any excat moment */
function todayWithFormat($format){
    return Carbon::now()->format($format);
}

/* Get any excat moment */
function previousLogin(){
    $log = Loginlog::where('user_id', auth()->user()->id)->orderBy('created_at', 'DESC')->skip(1)->take(1)->first();
    if($log){
        return $log->created_at->format('d/m/Y @ h:i');
    }
    return " this one";
}

/* Convert a "date" column to d-m-y format */
function convertDate($value){
    return Carbon::parse($value)->format('d/m/Y');
}

function checkPermissionFor($permission){
    if(!auth()->user()->can($permission) && !auth()->user()->can('do_all')){
        abort('403');
    }
}

function matchesWithInvitee($token){
	$invitee = Invitee::where('token', $token)->first();
	if($invitee){
		return true;
	}
	return false;
}

function composeMailBody(...$segments){
	$body = "";
	foreach($segments as $segment){
		if(is_array($segment)){
			$key = key($segment);
			$value = $segment[$key];
			$body .= $key . ': ' . $value . '<br/><br/>';
		}else{
			$body .= $segment . '<br/>';
		}
	}
	return $body;
}

function unreadMailCount(){
    return InboxMail::where('isTrash', false)
    					->where('isSent', false)
    					->where('isRead', false)
    					->where('isDraft', false)->get()->count();
}

function latestMails(){
    return InboxMail::where('isTrash', false)
    					->where('isSent', false)
    					->where('isDraft', false)->orderBy('created_at', 'DESC')->take(3)->get();
}

function draftMailCount(){
    return InboxMail::where('isTrash', false)
    					->where('isSent', false)
    					->where('isDraft', true)->get()->count();
}

function inboxLabels(){
	return ContactForm::all();
}

function isNotImage($mime){
	if($mime == 'image/jpeg'){
        return false;
    }
    elseif ($mime == 'image/png'){
        return false;
    }
    return true;
}

function getImageExtension($mime){
	if($mime == 'image/jpeg'){
        $extension = '.jpg';
    }
    elseif ($mime == 'image/png'){
        $extension = '.png';
    }
    return $extension;
}