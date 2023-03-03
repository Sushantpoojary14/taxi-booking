<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Driver;
use App\Models\Relation;

use Illuminate\Http\Request;
use App\Models\queue;
use App\Models\Category;
use App\Models\Customer;
use Illuminate\Support\Carbon;
use Razorpay\Api\Api;
class CustomerController extends Controller
{

    public $api;


    public function __construct(){
        $this->api = new Api("rzp_test_Pd1uy6stEdFpMs", "cFNsD9CtaRSZrmV5wHaxwd4Q");
        }
    public function index(request $request)
    {

        $data = Category::query()
            ->get();
        // dd($data);
        // $json = json_encode($data);

        // dd($json);
        return view('customer.index', compact('data'));
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

    public function payment(request $request){
        // dd($request->input());
        $customer = $request->input();
       $payment_details = $this->api
        ->order
        ->create(array('receipt' => '123', 'amount' => $request->fair*100, 'currency' => 'INR'
        , 'notes'=> array('fair'=> $request->fair,'phone'=> $request->phone,'name'=>$request->name)
            ));


        return view("customer.payment",compact('customer' ,'payment_details'));

    }
    public function billview(request $request)
    {
        $data =  json_decode($request->input()['customer']);
        //  dd($request->input());

        $currentDate = Carbon::now();

        $current_time = $currentDate->format('H:i:s');
        $current_date = $currentDate->format('Y-m-d');


        $drivers = Relation::query()

                ->where('category_id' ,$data->category )
                ->get();
                // dd($drivers);
        foreach ($drivers as $driver) {

                $d = queue::query()
                    ->where('relation_id', $driver->id)
                    ->where('status', 1)
                    ->orderBy('arrive_time', 'ASC')
                    ->first();
        }
        dd($d);
        Customer::query()
        ->create([
           'fullname'=>$data->name,
           'phone'=>$data->phone,
           'location'=>$data->to_loaction,
           'coordinate'=>$data->coordinate,
           'distance'=>$data->distance,
           'time_taken'=>$data->travel_time,
           'amount'=>$data->fair,
           'relation_id'=>$d->id,
           'payment_mode'=>"online payment",
           'booking_time'=> $current_time ,
           'booking_date'=> $current_date
        ]);

        return redirect('/');
        // return view('customer.contact');
    }

    public function category(){
        $category = Category::query()
        ->get();
        return json_encode($category);
    }

}
