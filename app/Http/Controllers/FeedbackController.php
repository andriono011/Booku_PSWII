<?php

namespace App\Http\Controllers;
use App\Models\Feedback;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index(){
        return view('contact.feedback');
    }

    public function addFeedback(Request $request){
        $request->validate([
            'nama'=>'required',
            'email'=>'required|email',
            'review'=>'required',
        ]);

        $feedback=New Feedback();
        $feedback->nama=$request->nama;
        $feedback->email=$request->email;
        $feedback->review=$request->review;
        $feedback->save();
        return redirect()->route('blog');
        }
}
