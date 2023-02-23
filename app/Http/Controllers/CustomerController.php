<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Driver;
use Illuminate\Http\Request;
use App\Models\queue;
use App\Models\Category;

class CustomerController extends Controller
{
    public function index(request $request)
    {

        $data = Category::query()
            ->get();
        // dd($data);
        $json = json_encode($data);

        // dd($json);
        return view('customer.index', compact('json','data'));
    }

    public function about(request $request)
    {


        return view('customer.about');
    }

    public function contact(request $request)
    {


        return view('customer.contact');
    }

    public function contactusform(request $request)
    {


        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
         ]);
        //  Store data in database
        Contact::create($request->all());

        \Mail::send('mail', array(
            'name' => $request->name,
            'email' => $request->email,
            'user_query' => $request->message,
        ), function($message) use ($request){
            $message->from($request->email);
            $message->to('shriramn1959@gmail.com', 'shriramn')->subject('Feedback Message');
        });
        //
        return back()->with('success', 'We have received your message and would like to thank you for writing to us.');
    }

}
