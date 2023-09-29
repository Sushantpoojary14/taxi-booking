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
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use App\Models\Permit;
class DriverController extends Controller
{
    protected $relationClass;
    protected $queueClass;
    protected $driverClass;
    protected $vehiclesClass;
    public function __construct()
    {
        $this->relationClass = Relation::class;

        $this->driverClass = Driver::class;
        $this->vehiclesClass = Vehicles::class;
        $this->queueClass = queue::class;
    }
    
     public function passwordMaker($vehicle_number,$category){
        $c = Category::query()
        ->where('id', $category)
        ->first();

        $number = str_split($vehicle_number);
        $pass = [];

        for ($i = count($number) - 4; $i < count($number); $i++) {
            $pass[] = $number[$i];
        }
        $pass = implode('', $pass);
        $pass2 = str_replace(' ', '', $c->type);

        $password = $pass2 . '@' . $pass;
        return $password;

    }
    
    public function create()
    {
        $category = Category::query()
        ->get();
        $permit = Permit::query()
        ->get();
        return view('driver.register',compact('category','permit'));
    }
    

    public function register(Request $request)
    {
        $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'max:255', 'unique:' . Driver::class],
            'car_type' => ['required'],
            'color' => ['required', 'string'],
            'model' => ['required', 'string', 'max:255'],
            'vehicle_number' => ['required', 'string', 'max:255', 'unique:' . Vehicles::class],
            // 'password' => ['required', ],
        ]);

       $password = $this->passwordMaker($request->vehicle_number, $request->car_type);
        // dd($password);

        $user = $this->driverClass::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($password),
            // 'password' =>  $password
        ]);

        $vehicle = $this->vehiclesClass::query()
            ->create([
                'vehicle_name' => $request->model,
                'vehicle_number' => $request->vehicle_number,
                'vehicle_color' => $request->color,
                'vehicle_permit' => $request->permit ,
                'category_id' => $request->car_type,

            ]);

        $this->relationClass::create([
            'driver_id' => $user->id,
            'category_id' => $request->car_type,
            'vehicle_id' => $vehicle->id,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }

    public function dashboard()
    {
        return view('driver.homepage');

    }
    public function queue(Request $request)
    {
        $id = Auth::user()->id;

        $user = $this->relationClass::getDriverById($id);

        $data = $this->queueClass::query()
        ->whereHas('relation', function ($query) use($user){
            $query
                ->where('category_id', $user->category_id);
                })
                ->orderBy('arrive_time', 'ASC')
                ->where('status', 1)
            ->with('relation.driver', 'relation.vehicles', 'relation.category')
            ->get();
                // dd();
        return view('driver.queue', compact('data', 'user'));
    }

    public function store(Request $request)
    {

        $id = Auth::user()->id;

        $driver = $this->relationClass::getDriverById($id);
        $queueRecord = $this->queueClass::query()
        ->where('relation_id', $driver->id)
        ->exists();
        $currentDate = Carbon::now();
        $current = $currentDate->format('Y-m-d h:i:s A');
        $this->queueClass::query()
            ->updateOrInsert(
                ['relation_id' => $driver->id],
                ['arrive_time' => $current, 'status' => 1]
            );
        
        return redirect()->back();

    }

    public function edit($id)
    {

         $data = $this->relationClass::getDriverById($id);
        $permit_id = explode(",",$data->vehicles->vehicle_permit);

        $category = Category::query()
            ->get();
        $permit = Permit::query()
            ->get();
        return view('driver.edit', compact('data', 'category', 'permit','permit_id'));
    }

    public function update(Request $request)
    {

         $id = $this->relationClass::getRelationById($request->id);
          $password = $this->passwordMaker($request->vehicle_number,$request->car_type);
       
        $this->driverClass::updateDriverById($id->driver_id, $request->only(['firstname', 'lastname', 'phone']),$password);

        $this->relationClass::query()
             ->where('id', $request->id)
            ->update([
                'category_id' => $request->car_type,
            ]);

        $this->vehiclesClass::updateVehicleById($id->vehicle_id, $request->only([ 'vehicle_name', 'vehicle_number', 'vehicle_color','vehicle_permit']), $request->car_type);


        return redirect()->route('driver.dashboard');
    }


    public function redirect()
    {
        return redirect()->route('driver/login');
    }
    public function exit()
    {
        $code = Qrcode::query()
            ->first();
        return view('driver.exit', compact('code'));
    }

    public function status(request $request)
    {

        // $user = Relation::query()
        //     ->where('driver_id', $request->id)
        //     ->first()
        // ;

        $this->queueClass::query()
            ->whereHas('relation', function($query) use($request){
                $query->where('driver_id', $request->id);
            })
            ->update([
                'status' => 0
            ]);

        return redirect()->route('driver.dashboard');
    }

}
