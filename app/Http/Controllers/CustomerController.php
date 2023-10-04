<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crypto;
use App\Models\Contact;
use App\Models\Driver;
use App\Models\Price;
use App\Models\Relation;
use Illuminate\Http\Request;
use App\Models\queue;
use App\Models\Category;
use App\Models\Customer;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Razorpay\Api\Api;
use App\Mail\MailNotify;
use App\Models\Permit;
use App\Models\Vehicles;
use Illuminate\Support\Facades\URL;

class CustomerController extends Controller
{

    public $api;
    public $relationClass;
    public $category;
    public $queue;
    public function __construct()
    {
        $this->api = new Api("rzp_test_Pd1uy6stEdFpMs", "cFNsD9CtaRSZrmV5wHaxwd4Q");
        $this->relationClass = Relation::class;
        $this->category = Category::class;
        $this->queue = queue::class;
    }


    public function DriverMessage($customer, $data)
    {
        $phone = '91' . $data->driver->phone;

        // $phone = '917798710272';
        $url = 'https://yohtaxi.com/map/' . $customer->id;

        $client = new \GuzzleHttp\Client();

        $response = $client->request('POST', 'https://control.msg91.com/api/v5/flow/', [
            'body' => '{"template_id":"64548e54d6fc0518552d12f2","sender":"AUTOFU","short_url":"1 (On) or 0 (Off)","mobiles":"' . $phone . '","name":"' . $customer->fullname . '","number":"' . $customer->phone . '","url":"' . $url . '"}',
            'headers' => [
                'accept' => 'application/json',
                'authkey' => '391731AFktd64R1R46406d721P1',
                'content-type' => 'application/json',
            ],
        ]);

        // echo $response->getBody();
    }

    public function CustomerMessage($customer, $data)
    {
        $phone = '91' . $customer->phone;
        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', 'https://control.msg91.com/api/v5/flow/', [
            'body' => '{"template_id":"6458bd45d6fc053877615602","sender":"AUTOFU","short_url":"1 (On) or 0 (Off)","mobiles":"' . $phone . '","invoice_id":"' . $customer->invoice_id . '","name":"' . $data->driver->firstname . '","number":"' . $data->driver->phone . ' , ' . $data->vehicles->vehicle_number . '"}',
            'headers' => [
                'accept' => 'application/json',
                'authkey' => '391731AFktd64R1R46406d721P1',
                'content-type' => 'application/json',
            ],
        ]);
        // echo $response->getBody();
    }

    public function index(request $request)
    {
        // $category = $this->category::category();
        $data = null;
        $data = $this->queue::query()
            ->where('status', 1)
            ->orderBy('arrive_time', 'ASC')
            ->with('relation.category')
            ->get('relation_id');

        $category = [];
        foreach ($data as $key => $value) {
            $category[] = $value->relation->category;
        }
        $category = array_unique($category);

        return view('customer.index', compact('category'));
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
        $data = $request->input();
        Mail::send(new MailNotify($data));
        $request->session()->flash('success', 'success');
        return redirect()->back();


    }


    //  public function payment(request $request)
    // {
    //     $request->validate([
    //         'name' => ['required', 'string', 'max:255'],
    //         'phone' => ['required', 'max:255'],
    //         'category'=> ['required'],
    //         'total_fair'=>['required']
    //     ]);

    //     $data = $request->input();
    //     $customer = json_encode($request->input());

    //     // dd($request->category);
    //     $currentDate = Carbon::now();
    //     $current = $currentDate->format('d-m-y H:i:s');
    //     $current_time = $currentDate->format('H:i:s');

    //     $randomString = '';
    //     $count = Customer::query()->count();
    //     $current_year = $currentDate->format('y');
    //     $current_date = $currentDate->format('d-m-y');
    //     $randomString = $current_year . "-" . ((int) $current_year + 1) . "-ATC-" . ($count + 1);


    //     $order_id = 'order_' . rand(1111111111,9999999999);
    //      $t_id = 'Transaction_' . rand(111111111,999999999) ;

    //   return view('payment.form')->with(session([
    //         'customer' => $data,
    //         'randomString' => $randomString,
    //         'order_id'=>$order_id,
    //         'data'=>$customer
    //     ]));

    // }
    public function c_payment($data)
    {

        $working_key = 'FD91F30C65ABFCB0B0A75C2C5C8290D2';
        $crypt = new Crypto;
        $rcvdString = $crypt->newdecrypt($data, $working_key);
        $order_status = "";
        $decryptValues = explode('&', $rcvdString);
        $dataSize = sizeof($decryptValues);


        for ($i = 0; $i < $dataSize; $i++) {
            $information = explode('=', $decryptValues[$i]);
            $payment_data[$information[0]] = $information[1];
            if ($i == 3) {
                $order_status = $information[1];
            }
        }

        return [$decryptValues, $dataSize, $order_status];
    }

    public function payment(request $request)
    {
        // dd($request->input());
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'max:255'],
            'category' => ['required'],
        ]);
        $currentDate = Carbon::now();
        $current_date = $currentDate->format('d-m-Y');
        $current = $currentDate->format('d-m-y H:i:s');
        $current_time = $currentDate->format('H:i:s');

        $randomString = '';
        $count = Customer::query()->count();
        $current_year = $currentDate->format('y');
        $randomString = $current_year . "-" . ((int) $current_year + 1) . "-ATC-" . ($count + 1);

        // dd($request->url);
        // $order_id = 'order_' . rand(1111111111,9999999999);
        // $t_id = 'Transaction_' . rand(111111111,999999999) ;
        // dd($order_id);
        $driver = $this->queue::query()
            ->where('status', 1)
            ->orderBy('arrive_time', 'ASC')
            ->whereHas('relation', function ($query) use ($request) {
                $query->where('status', 1)
                    ->where('category_id', $request->category);
            })
            ->first('relation_id');
        $category = $this->category::query()
        ->where('id', $request->category)
        ->first();
        $total_fair = (int)$category->fair * (int)$request->days;
        if (!$driver) {
            return redirect()->back();
        }
        $this->queue::status($driver->relation_id);
        // dd( $driver->relation_id);
        $customer = Customer::query()
            ->create([
                'fullname' => $request->name,
                'phone' => $request->phone,
                // 'location' => $request->to_loaction,
                // 'coordinate' => $request->coordinate,
                // 'distance' => $request->distance,
                // 'time_taken' => $request->travel_time,
                // 'amount' => $request->fair,
                'total_amount' => $total_fair,
                // 'customer_token' => $request->c_token,
                'relation_id' =>  $driver->relation_id,

                'invoice_id' => $randomString,
                // 'url' => $request->url,
                // 'payment_mode' => "online Book",
                'days' => $request->days,
                'payment_mode' => $request->payment,
                // 'payment_id' => $order_id,
                // 'night_charges' => $request->night_charges,
                'booking_time' => $current_time,
                'booking_date' => $current_date
            ]);

        $category = $request->category;
        $request->session()->flash('success', 'success');
        return redirect()->back();
        //  return view('payment.form', compact('order_id', 'customer','category'));
        // return view('customer.index');

    }

    public function c_billview()
    {
        $data = session('data');
        $customer = session('customer');
        $price = session('price');

        // dd($customer);
        return View('customer.billview', compact('data', 'customer', 'price'));
    }
    public function category()
    {
        $category = Category::query()
            ->get();

        return response()->json([

            // 'messages' => "Success",
            'category' => $category
        ], 200);
        // return json_encode($category);
    }

    public function priceapi()
    {
        $price = Price::query()
            ->first();
        return response()->json([
            'price' => $price
        ], 200);

    }

    public function availabilityapi(Request $request)
    {
        $data = null;
        // $permit = json_decode($request->input());
        // dd($request->optional);
        $data = $this->queue::query()
            ->where('status', 1)
            ->orderBy('arrive_time', 'ASC')
            ->whereHas('relation', function ($query) use ($data) {
                $query->where('status', 1);
            })
            ->with('relation.category')
            ->get('relation_id');

        $category = [];

        foreach ($data as $key => $value) {
            $category[] = $value->relation->category;
        }
        $category = array_values(array_unique($category));

        $permit = Permit::query()->get();

        return response()->json([
            'category' => $category,
            'permit' => $permit,
            'optional' => $request->optional
        ], 200);


    }

    public function response(Request $request)
    {
        $encResponse = $request->encResp;

        $res = $this->c_payment($encResponse);
        $payment_data = array();
        for ($i = 0; $i < $res[1]; $i++) {
            $information = explode('=', $res[0][$i]);
            $payment_data[$information[0]] = $information[1];
        }

        if ($res[2] === "Aborted" || $res[2] === "Failure") {

            Customer::query()->where('id', $payment_data['merchant_param1'])->delete();
            return view('customer.payment');
        }

        $driver = $this->queue::query()
            ->where('status', 1)
            ->orderBy('arrive_time', 'ASC')
            ->whereHas('relation', function ($query) use ($payment_data) {
                $query->where('status', 1)
                    ->where('category_id', $payment_data['merchant_param2']);
            })
            ->first('relation_id');


        $this->queue::status($driver->relation_id);
        Customer::query()
            ->where('id', $payment_data['merchant_param1'])
            ->update(array('relation_id' => $driver->relation_id, 'payment_id' => $payment_data['order_id'], ));

        $customer = Customer::query()->where('id', $payment_data['merchant_param1'])->first();

        $data = $this->relationClass::query()
            ->where('id', $driver->relation_id)
            ->with('driver', 'vehicles', 'category')
            ->first();
        $price = Price::query()->first();

        $this->CustomerMessage($customer, $data);
        $this->DriverMessage($customer, $data);

        $request->session()->flash('success', 'success');

        return redirect()->route('c_billview')->with(session([
            'data' => $data,
            'customer' => $customer,
            'price' => $price
        ]));




    }


}
