<?php

namespace App\Http\Controllers;
use Mail;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller {

    public function getForm()
    {
        return view('contact');
    }

    public function postForm(ContactRequest $request)
    {
        Mail::send('contact', $request->all(), function($message)
        {
            $message->to('thomas.leclerc7@orange.fr')->subject('Contact'); //modifier addresse attention erreur ->to
        });

        return view('confirm');
    }

}