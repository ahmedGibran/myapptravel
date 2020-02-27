<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Pagecontroller extends Controller
{
    public function postContact(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:2|string',
            'email' => 'required|email',
            'subject' => 'required|digits:10',
            'message' => 'required|min:10'
        ]);

        $data = array(
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'bodyMessage' => $request->message
        );

        Mail::send('emails.contact', $data, function($message) use ($data){
            $message->from($data['email']);
            $message->to('ahmedgpraan@gmail.com');
            $message->subject($data['name']);
        });

        Session::flash('success', 'Your email has been sent');

        return view('index');
    }
}
