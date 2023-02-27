<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use Illuminate\Http\Request;
use App\Models\queue;
use App\Models\Relation;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use App\Models\Vehicles;
use App\Models\Qrcode;

class DriverController extends Controller
{

    public function dashboard()
    {
        $code = Qrcode::query()
            ->first();

        return view('homepage', compact( 'code'));


    }
    public function queue(Request $request)
    {
        $id = Auth::user()->id;

        $user = Relation::query()
        ->where('driver_id', $id)
        ->first();

        $drivers = queue::query()
            ->where('status', 1)
            ->orderBy('arrive_time', 'ASC')
            ->get();

        foreach ($drivers as $driver) {

            $data[] = Relation::query()
                ->where('id', $driver->relation_id)
                ->where('category_id', $user->category_id)
                ->with('driver')
                ->with('vehicles')
                ->with('category')
                ->get();

        }



        // dd($data);
        return view('queue', compact('data','drivers','user'));
    }
    public function store(Request $request)
    {


        $id = Auth::user()->id;

        $driver = Relation::query()
            ->where('driver_id', $id)
            ->first();



        $user = queue::query()
            ->where('relation_id', $driver->id)
            ->first();


        if ($user === null) {
            queue::create([
                'relation_id' => $driver->id,
                'arrive_time' => $request->time
            ]);
            return redirect()->back();
        } else {
            queue::query()
                ->where('relation_id', $driver->id)
                ->update([
                    'arrive_time' => $request->time,
                    'status' => 1
                ]);
            return redirect()->back();
        }





    }
    public function edit()
    {

        $id = Auth::user()->id;
        $driver = Relation::query()
            ->where('driver_id', $id)
            ->first();

        $data = Relation::query()
            ->where('id', $driver->id)
            ->with('driver')
            ->with('vehicles')
            ->with('category')
            ->first();

        $category = Category::query()

            ->get();

        return View('edit', compact('data', 'category'));
    }

    public function update(Request $request)
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


        return redirect()->route('dashboard');
    }


    public function redirect()
    {
        return redirect()->route('/login');
    }
    public function exit()
    {
        $code = Qrcode::query()
            ->first();
        return view('exit', compact('code'));
    }

    public function status(request $request)
    {

        $user = Relation::query()
            ->where('driver_id', $request->id)
            ->first()
        ;

        queue::query()
            ->where('relation_id', $user->id)
            ->update([
                'status' => 0
            ]);

        return redirect()->route('dashboard');
    }

}
