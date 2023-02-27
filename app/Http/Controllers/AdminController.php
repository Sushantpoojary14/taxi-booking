<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin;
use App\Models\Driver;
use App\Models\queue;
use App\Models\Relation;
use App\Models\Vehicles;
use App\Models\Category;
use App\Models\Customer;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Symfony\Component\Console\Input\Input;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{

    public function index()
    {
        $data = Relation::
            query()
            ->with('driver')
            ->with('vehicles')
            ->with('category')
            ->get();
        // foreach ($data as $record) {
        //     dd($record['driver']);
        // }
        // dd($data);
        return View('admin.dashboard', compact('data'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        // dd($request->input());
        $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . Driver::class],
            'phone' => ['required', 'numeric', 'min:10', 'unique:' . Driver::class],
            'car_type' => ['required', 'string', 'max:255'],
            'car_number' => ['required', 'string', 'max:255', 'unique:' . Driver::class],
            'password' => [
                'required',
            ],
        ]);




        $driver = Driver::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'type_of_car' => $request->car_type,
            'car_number' => $request->car_number,
            'fair' => $request->fair,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,

            'password' => Hash::make($request->password),
        ]);
        return redirect()->back();
    }


    public function show(request $request)
    {
        $fillter = $request->car_type;
        if ($fillter == null) {
            $fillter = 1;
        }

        $category = Category::query()
            ->get();

        $drivers = queue::query()
            ->where('status', 1)
            ->orderBy('arrive_time', 'ASC')
            ->get();
        $data = [];
        foreach ($drivers as $driver) {

            $data[] = Relation::query()
                ->where('id', $driver->relation_id)
                ->with('driver')
                ->with('vehicles')
                ->with('category')
                ->get();
        }


        return View('admin.queue', compact('data', 'drivers', 'category', 'fillter'));

    }


    public function edit(Item $item, $id)
    {
        $data = Relation::query()
            ->where('id', $id)
            ->with('driver')
            ->with('vehicles')
            ->with('category')
            ->first();

        $category = Category::query()

            ->get();


        return View('admin.edit', compact('data', 'category'));

    }


    public function update(Request $request, Item $item)
    {


        $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],

            'phone' => [
                'required',
                'string',
                'min:10',
            ],
            'car_type' => ['required', 'string', 'max:255'],
            'car_number' => ['required', 'string', 'max:255'],


        ]);

        $id = Relation::query()
            ->where('id', $request->id)
            ->first();

        Driver::query()
            ->where('id', $id->driver_id)
            ->update([

                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'email' => $request->email,
                'phone' => $request->phone,
                // 'password' => Hash::make($request->password),


            ]);

        $category = Category::query()
            ->where('type', $request->car_type)
            ->first();

        Relation::query()
            ->where('id', $id->id)
            ->update([

                'category_id' => $category->id,

            ]);



        Vehicles::query()
            ->where('id', $id->vehicle_id)
            ->update([
                'vehicle_name' => $request->model,
                'car_number' => $request->car_number,
                'color' => $request->color,
                'category_id' => $category->id,
            ]);


        return redirect()->route('admin.dashboard');
    }


    public function destroy(Item $item, $id)
    {
        $id = Relation::query()
            ->where('id', $id)
            ->first();

        Driver::query()
            ->where('id', $id->driver_id)
            ->delete();

        Vehicles::query()
            ->where('id', $id->vehicle_id)
            ->delete();

        Relation::query()
            ->where('id', $id->id)
            ->delete();

        return redirect()->route('admin.dashboard');
    }

    public function queuedispatch($id)
    {
        // dd($id);
        queue::query()
            ->where('relation_id', $id)
            ->update([
                'status' => 0
            ]);

        return redirect()->route('admin.queue');
    }

    public function status($id, request $request)
    {

        Relation::query()
            ->where('id', $id)

            ->update([
                'status' => $request->status,
                'active_status' => 0
            ]);

        queue::query()
            ->where('relation_id', $id)
            ->update([
                'status' => 0
            ]);

        return redirect()->back();
    }

    public function printedit($id, request $request)
    {
        $data = Relation::query()
            ->where('id', $id)
            ->with('driver')
            ->with('vehicles')
            ->with('category')
            ->first();
        $detail = $request->input();


        return View('admin.editprint', compact('data', 'detail'));
    }

    public function print(request $request)
    {
        $detail = $request->input();

        $data = Relation::query()
            ->where('id', $request->id)
            ->with('driver')
            ->with('vehicles')
            ->with('category')
            ->first();

        $currentDate = Carbon::now();
        $current = $currentDate->format('Y-m-d H:i:s');
        $current_time = $currentDate->format('H:i:s');
        $current_date = $currentDate->format('Y-m-d');

        $allowedPayments = ['cash', 'card', 'upi'];

        $request->validate([
            'fullname' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string'],
            'fair' => ['required', 'string'],
            'payment' => ['required', Rule::in($allowedPayments)],
            'parking_charges' => ['required', 'string'],

        ]);

        $total = $request->fair + $request->night_fair;
        $gst = 5 * $total / 100;
        $total = $total + $gst + $request->parking_charges;




        if ($request->c_id == null) {
            $customer = Customer::create([
                'fullname' => $request->fullname,
                'location' => $request->location,
                'relation_id' => $request->id,

                'amount' => $total,
                'payment_mode' => $request->payment,
                // 'phone' => $request->phone,
                'booking_time' => $current_time,
                'booking_date' => $current_date,
            ]);
        } else {
            $customer = Customer::query()
                ->where('id', $request->c_id)
                    // ->first()
                ->update([
                    'fullname' => $request->fullname,
                    'location' => $request->location,
                    // 'relation_id' => $request->id,

                    'amount' => $total,
                    'payment_mode' => $request->payment,
                    // 'phone' => $request->phone,
                    'booking_time' => $current_time,
                    'booking_date' => $current_date,
                ]);

            $customer = Customer::query()
                ->where('id', $request->c_id)
                ->first();
        }

        // dd($customer->id);

        return View('admin.printview', compact('data', 'current', 'total', 'customer', 'detail', 'gst'));
    }

    public function showtrip(request $request)
    {

        $fillter = $request->car_type;
        if ($fillter == null) {
            $fillter = 1;
        }

        $current = $request->date;

        $currentDate = Carbon::now();

        $current_date = $currentDate->format('Y-m-d');
        // dd($current_date);
        if ($current == null) {
            $current = $current_date;
        }

        $category = Category::query()
            ->get();

        $drivers = Customer::query()
            ->where('booking_date', $current)
            ->get();

        $data = [];
        foreach ($drivers as $key =>$driver) {
            $data[] = Relation::query()
                ->where('id', $driver->relation_id)
                ->with('customer')
                ->with('driver')
                ->with('vehicles')
                ->with('category')
                ->paginate(10);


        }

        // }
        // dd($drivers);

        // echo print_r($data[0]->customer, true);


        return view('admin.trip', compact('data', 'drivers', 'category', 'fillter', 'current'));

    }
}
