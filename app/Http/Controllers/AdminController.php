<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Http\Controllers\Controller;
use App\Models\Price;
use Illuminate\Http\Request;
use App\Models\admin;
use App\Models\Driver;
use App\Models\queue;
use App\Models\Relation;
use App\Models\Vehicles;
use App\Models\Category;
use App\Models\Customer;
use Illuminate\Support\Carbon;
use App\Models\Permit;
use App\Models\Url;
use PHPUnit\TestFixture\Success;

class AdminController extends Controller
{
    protected $relationClass;
    protected $queueClass;
    protected $driverClass;
    protected $categoryClass;
    protected $vehiclesClass;
    protected $customerClass;
    public function __construct()
    {
        $this->relationClass = Relation::class;
        $this->categoryClass = Category::class;
        $this->driverClass = Driver::class;
        $this->vehiclesClass = Vehicles::class;
        $this->queueClass = queue::class;
        $this->customerClass = Customer::class;
    }


    protected function category()
    {
        return $this->categoryClass::query()
            ->get();
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
    public function DriverMessage($customer, $data)
    {

        $phone = '91' . $data->driver->phone;

        // $phone = '917798710272';
        $url = 'http://yohtaxi.com/map/' . $customer->id;

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

    public function url($id)
    {
        $data = Customer::query()->where('id', $id)->first();
        if ($data == null) {
            return redirect('/');

        }
        $url = $data->url;
        // dd($url);
        return view('customer.url', compact('url'));

    }
    public function index()
    {
        // $data = $this->relationClass::query()
        //     ->with('driver')
        //     ->with('vehicles')
        //     ->with('category')
        //     ->get();

        return View('admin.dashboard');
    }
    public function indexapi()
    {
        $data = $this->relationClass::query()
            ->with('driver')
            ->with('vehicles')
            ->with('category')
            // ->offset(0)->limit(10)
            ->get();

        return response()->json(
            $data

        );
    }
    public function show(request $request)
    {

        return View('admin.queue');

    }
    public function EditPrice(request $request)
    {
        $category = $this->category();
        return View('admin.editcprice');

    }
    public function updatePrice(request $request)
    {
        $this->categoryClass::query()
            ->where('id', $request->car_type)
            ->update(['fair' => $request->price]);

        return redirect()->back();

    }
    public function queueapi(request $request)
    {
        //  $category = $this->category();

        $data = $this->queueClass::query()
            ->whereHas('relation', function ($query) use ($request) {
                $query->where('category_id', $request->input('id'));
            })
            ->where('status', 1)
            ->orderBy('arrive_time', 'ASC')
            ->with('relation.driver', 'relation.vehicles', 'relation.category')
            ->get();

        return response()->json([
            $data
        ], 200);

    }

    public function categoryapi(request $request)
    {
        $category = $this->category();

        return response()->json([
            $category
        ], 200);

    }

    public function test(request $request)
    {
        $category = $this->category();

        $data = $this->relationClass::query()
            ->with('driver')
            ->with('vehicles')
            ->with('category')
            ->offset($request->input('start'))
            ->limit($request->input('last'))
            ->get();

        return response()->json(
            $data
        );

    }

    public function edit($id)
    {
        $data = $this->relationClass::getRelationById($id);
        $permit_id = explode(",", $data->vehicles->vehicle_permit);

        $category = Category::query()
            ->get();
        $permit = Permit::query()
            ->get();


        return View('admin.edit', compact('data', 'category', 'permit', 'permit_id'));

    }

    public function update(Request $request)
    {


        $id = $this->relationClass::getRelationById($request->id);

        $c = Category::query()
            ->where('id', $id->category_id)
            ->first();
        // dd($c);
        $number = str_split($request->vehicle_number);
        $pass = [];

        for ($i = count($number) - 4; $i < count($number); $i++) {
            $pass[] = $number[$i];
        }
        $pass = implode('', $pass);
        $pass2 = str_replace(' ', '', $c->type);

        $password = $pass2 . '@' . $pass;

        //  dd($password);
        $this->driverClass::updateDriverById($id->driver_id, $request->only(['firstname', 'lastname', 'phone']), $password);

        $this->relationClass::query()
            ->where('id', $request->id)
            ->update([
                'category_id' => $request->car_type,
            ]);

        $this->vehiclesClass::updateVehicleById($id->vehicle_id, $request->only(['vehicle_name', 'vehicle_number', 'vehicle_color', 'vehicle_permit']), $request->car_type);


        return redirect()->route('admin.dashboard');
    }

    public function destroy($id)
    {
        dd($id);
        $id = $this->relationClass::getRelationById($id);

        $this->driverClass::query()
            ->where('id', $id->driver_id)
            ->delete();

        $this->vehiclesClass::query()
            ->where('id', $id->vehicle_id)
            ->delete();

        $this->relationClass::query()
            ->where('id', $id->id)
            ->delete();
        $this->queueClass::query()->where('relation_id', $id->id)
            ->delete();

        // return redirect()->route('admin.dashboard');
    }

    public function queuedispatch($id)
    {

        $this->queueClass::status($id);

        return redirect()->route('admin.queue');
    }

    public function status(request $request)
    {
        $data = $request->input();

        // dd($request->input());
        $this->relationClass::query()
            ->where('id', $request->id)
            ->update([
                'status' => $request->input('status')
            ]);

        $this->queueClass::status($request->input('id'));

        return response()->json([
            'message' => 'success!'
        ]);

    }

    public function printedit($id, request $request)
    {

        $data = $this->relationClass::query()
            ->where('id', $id)
            ->first(['category_id', 'id']);

        $detail = $request->input();
        $randomString = '';
        $count = $this->customerClass::query()->count();
        $currentDate = Carbon::now();
        $current_year = $currentDate->format('y');
        $current_date = $currentDate->format('d-m-y');
        $randomString = $current_year . "-" . ((int) $current_year + 1) . "-ATC-" . ($count + 1);
        return View('admin.editprint', compact('randomString', 'id', 'data'));
    }

    public function print(request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'max:255'],
        ]);

        $data = $this->relationClass::getRelationById($request->id);

        $category = $this->categoryClass::query()
            ->where('id', $data->category_id)
            ->first();

        $total_fair = (int) $category->fair * (int) $request->days;
        // dd($request->input());
        $this->queueClass::status($request->id);
        // $price = Price::query()
        //     ->first();

        $currentDate = Carbon::now();

        $current_time = $currentDate->format('h:i:s A');
        $current_date = $currentDate->format('d-m-Y');

        $this->customerClass::query()
            ->updateOrInsert(
                [
                    'invoice_id' => $request->invoice,
                ],
                [
                    'fullname' => $request->name,
                    'phone' => $request->phone,
                    // 'location' => $request->to_loaction,
                    // 'coordinate' => $request->coordinate,
                    // 'distance' => $request->distance,
                    // 'time_taken' => $request->travel_time,
                    // 'amount' => $request->fair,
                    'total_amount' => $total_fair,
                    'relation_id' => $request->id,
                    'payment_mode' => $request->c_payment,
                    // 'customer_token'=>$request->c_token,
                    'days' => $request->days,
                    'invoice_id' => $request->invoice,
                    // 'url' => $request->url,
                    // 'razorpay_payment_id' => $transaction->razorpay_payment_id,
                    // 'night_charges' => $request->night_charges,
                    'booking_time' => $current_time,
                    'booking_date' => $current_date
                ]
            );
        // $customer = $this->customerClass::query()->where('invoice_id', $request->invoice)->first();
        // $this->CustomerMessage($customer, $data);
        // $this->DriverMessage($customer, $data);
        $request->session()->flash('success', 'success');
        return redirect()->route('admin.queue');
    }

    public function showtrip(request $request)
    {
        // dd($request->time);
        $filter = $request->car_type;

        if ($filter == null) {
            $filter = 2;
        }

        $current = $request->date;

        if ($current == null) {
            $currentDate = Carbon::now();
            $current_date = $currentDate->format('d-m-Y');
            $current = $current_date;
        } else {
            $current = date("d-m-Y", strtotime($current));
        }
        // dd($current);

        $customer = $this->customerClass::query()
            ->when($request->time == 'month', function ($query) use ($current) {
                $month = date('d-m-Y', strtotime($current . '-1 months'));
                $query->whereRaw("STR_TO_DATE(booking_date, '%d-%m-%Y') BETWEEN STR_TO_DATE('$month', '%d-%m-%Y') AND STR_TO_DATE('$current', '%d-%m-%Y')");
                // $query->whereBetween('booking_date', [$month, $current]);
                // dd($month,$current);
            })
            ->when($request->time == 'week', function ($query) use ($current) {
                $week = date('d-m-Y', strtotime($current . '-1 week'));
                $query->whereRaw("STR_TO_DATE(booking_date, '%d-%m-%Y') BETWEEN STR_TO_DATE('$week', '%d-%m-%Y') AND STR_TO_DATE('$current', '%d-%m-%Y')");
                // dd($current,$week);
            })
            ->when($request->time == 'day' || $request->time == null, function ($query) use ($current) {
                // $week = date('d-m-Y', strtotime($current . '-1 week'));
                $query->where('booking_date', $current);
                // dd($current);

            })
            ->orderBy('booking_date')
            ->whereHas('relation', function ($query) use ($filter) {
                $query->where('category_id', $filter);
            })
            ->with('relation.driver', 'relation.vehicles', 'relation.category')
            ->get();

        $data = $customer;
        $temp_customer = [];
        $date = [];
        foreach ($customer as $key => $value) {
            $temp_customer[] = $value->relation;
            $date[] = $value->booking_date;
        }
        // dd( $date);
        $temp_customer = array_unique($temp_customer);
        $driverIds = collect($temp_customer)->pluck('id');
        $drivers = $this->relationClass::query()
            ->whereIn('id', $driverIds)
            ->get();
        // dd( $customer);
        $category = $this->category();
        $current = date("Y-m-d", strtotime($current));
        return view('admin.trip', compact('drivers', 'category', 'filter', 'current', 'data'));

    }

    public function billview()
    {
        $currentDate = Carbon::now();
        $current_year = $currentDate->format('y');
        $current_date = $currentDate->format('d-m-y');
        $randomString = $current_year . "-" . ((int) $current_year + 1) . "-ATC-";
        return view('admin.billbiew', compact('randomString'));
    }

    public function viewdetail($id, request $request)
    {

        $current = $request->date;

        if ($current == null) {
            $currentDate = Carbon::now();
            $current_date = $currentDate->format('d-m-Y');
            $current = $current_date;
        } else {
            $current = date("d-m-Y", strtotime($current));
        }
        $customer = $this->customerClass::query()
            ->where('relation_id', $id)
            ->when($request->time == 'month', function ($query) use ($current) {
                $month = date('d-m-Y', strtotime($current . '-1 months'));
                $query->whereRaw("STR_TO_DATE(booking_date, '%d-%m-%Y') BETWEEN STR_TO_DATE('$month', '%d-%m-%Y') AND STR_TO_DATE('$current', '%d-%m-%Y')");
                // $query->whereBetween('booking_date', [$month, $current]);
                // dd($month,$current);
            })
            ->when($request->time == 'week', function ($query) use ($current) {
                $week = date('d-m-Y', strtotime($current . '-1 week'));
                $query->whereRaw("STR_TO_DATE(booking_date, '%d-%m-%Y') BETWEEN STR_TO_DATE('$week', '%d-%m-%Y') AND STR_TO_DATE('$current', '%d-%m-%Y')");
                // $query->whereBetween('booking_date', [$week, $current]);
                // dd($current,$week);
            })
            ->when($request->time == 'day' || $request->time == null, function ($query) use ($current) {
                // $week = date('d-m-Y', strtotime($current . '-1 week'));
                $query->where('booking_date', $current);
                // dd($current);
            })
            ->orderBy('booking_date')
            ->get();

        $driver = $this->relationClass::query()
            ->where('id', $id)
            ->with('driver', 'Vehicles')
            ->first();

        $current = date("Y-m-d", strtotime($current));

        return view('admin.tripdetails', compact('customer', 'current', 'driver'));
    }
    public function generatebill(request $request)
    {

        $customer = $this->customerClass::query()->where('invoice_id', $request->invoice_id)->first();
        // dd($customer);
        if ($customer == null) {

            $request->session()->flash('message', 'No such Invoice Id');
            return redirect()->back();
        }

        $price = Price::query()
            ->first();
        $data = $this->relationClass::getRelationById($customer->relation_id);

        return View('admin.printview', compact('data', 'customer', 'price'));

    }
    public function editdetails(request $request)
    {

        $customer = $this->customerClass::query()->where('invoice_id', $request->invoice_id)->first();

        if ($customer == null) {
            $request->session()->flash('message', 'No such Invoice Id');
            return redirect()->back();
        }

        $price = Price::query()->first();
        $category = $this->categoryClass::query()
            ->get();
        $data = $this->relationClass::getRelationById($customer->relation_id);

        return View('admin.editdetails', compact('data', 'customer', 'price', 'category'));

    }

    public function adminavailabilityapi(request $request)
    {
        $filter = $request->car_type;
        if ($filter == null) {
            $filter = 2;
        }

        $driver = $this->relationClass::query()
            ->where('status', 1)
            ->where('category_id', $filter)
            ->whereHas('queue', function ($query) {
                $query->where('status', 1);

            })
            ->with('vehicles')
            ->limit(10)
            ->get();
        $category = $this->categoryClass::query()
            ->get();
        $price = Price::query()->first();
        return response()->json([
            'driver' => $driver,
            'category' => $category,
            'price' => $price
        ], 200);



    }

    public function updatedetails(request $request)
    {

        $this->customerClass::query()
            ->where('invoice_id', $request->invoice_id)
            ->update(
                array(
                    'relation_id' => $request->id,
                    'amount' => $request->fair,
                    'total_amount' => $request->total_fair
                )
            );
        $customer = $this->customerClass::query()->where('invoice_id', $request->invoice_id)->first();

        $price = Price::query()->first();

        $data = $this->relationClass::getRelationById($customer->relation_id);
        $this->CustomerMessage($customer, $data);
        $this->DriverMessage($customer, $data);
        return View('admin.printview', compact('data', 'customer', 'price'));

    }
}
