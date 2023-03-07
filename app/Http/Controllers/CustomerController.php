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


    public function __construct()
    {
        $this->api = new Api("rzp_test_Pd1uy6stEdFpMs", "cFNsD9CtaRSZrmV5wHaxwd4Q");
    }
    public function index(request $request)
    {


        $data = Category::query()
            ->get();
        $drivers = queue::query()
            ->where('status', 1)
            ->orderBy('arrive_time', 'ASC')
            ->get();
            // dd(empty($drivers[0]));
        if (empty($drivers[0])==true) {
            $data = null;
            $category=null;
            return view('customer.index', compact('data', 'category'));
        }

        foreach ($drivers as $driver) {
            $temp = Relation::query()
                ->where('id', $driver->relation_id)
                ->first();
            if ($temp != null) {
                $id[] = $temp;
            }

        }

        foreach ($id as $value) {

            $category[] = $value->category_id;


        }

        $category = array_unique($category);

        // dd( $category);
        return view('customer.index', compact('data', 'category'));
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
        ), function ($message) use ($request) {
            $message->from($request->email);
            $message->to('shriramn1959@gmail.com', 'shriramn')->subject('Feedback Message');
        });
        //
        return back()->with('success', 'We have received your message and would like to thank you for writing to us.');
    }

    public function payment(request $request)
    {
        // dd($request->input());
        $customer = $request->input();

        // $drivers = queue::query()
        // ->where('status', 1)
        // ->orderBy('arrive_time', 'ASC')
        // ->get();


        // foreach ($drivers as $driver) {
        //     $temp = Relation::query()
        //         ->where('id', $driver->relation_id)
        //         ->where('category_id',$request->category)
        //         ->first();
        //     if ($temp != null) {
        //         $id[] = $temp;
        //     }

        // }

        // dd($id);
        $payment_details = $this->api
            ->order
            ->create(
                array(
                    // 'receipt' => '123',
                    'amount' => $request->fair * 100,
                    'currency' => 'INR'
                    ,
                    'notes' => array('fair' => $request->fair, 'phone' => $request->phone, 'name' => $request->name)
                )
            );


        return view("customer.payment", compact('customer', 'payment_details'));

    }
    public function billview(request $request)
    {
        $data = json_decode($request->input()['customer']);
        $transaction = json_decode($request->input()['transaction_details']);
        //  dd($transaction->razorpay_payment_id);

        $currentDate = Carbon::now();

        $current_time = $currentDate->format('H:i:s');
        $current_date = $currentDate->format('Y-m-d');



        $drivers = queue::query()

            ->where('status', 1)
            ->orderBy('arrive_time', 'ASC')
            ->get();
        // dd($drivers);

        foreach ($drivers as $driver) {
            $temp = Relation::query()
                ->where('id', $driver->relation_id)
                ->where('category_id', $data->category)
                ->first();
            if ($temp != null) {
                $id[] = $temp;
            }
        }
        // dd($id);
        queue::query()
            ->where('relation_id', $id[0]->id)
            ->update([
                'status' => 0
            ]);

        Customer::query()
            ->create([
                'fullname' => $data->name,
                'phone' => $data->phone,
                'location' => $data->to_loaction,
                'coordinate' => $data->coordinate,
                'distance' => $data->distance,
                'time_taken' => $data->travel_time,
                'amount' => $data->fair,
                'relation_id' => $id[0]->id,
                'payment_mode' => "online payment",
                'razorpay_payment_id' => $transaction->razorpay_payment_id,
                'booking_time' => $current_time,
                'booking_date' => $current_date
            ]);
            
        return redirect('/')->with('success', 'success!');
        // return view('customer.contact');
    }

    public function category()
    {
        $category = Category::query()
            ->get();

        return json_encode($category);
    }

    public function availability()
    {
        $drivers = queue::query()
            ->where('status', 1)
            ->orderBy('arrive_time', 'ASC')
            ->get();


        foreach ($drivers as $driver) {
            $temp = Relation::query()
                ->where('id', $driver->relation_id)
                ->first();
            if ($temp != null) {
                $id[] = $temp;
            }

        }
        foreach ($id as $value) {

            $category[] = $value->category_id;


        }
        $data = Category::query()
            ->get();
        $category = array_unique($category);

        return json_encode([$data, $category]);


    }


}
