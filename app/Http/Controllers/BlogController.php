<?php

namespace App\Http\Controllers;
use App\Models\Feedback;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(){
        $dataBlog=Feedback::all();
        return view('blog', compact('dataBlog'));

    }
    
}
