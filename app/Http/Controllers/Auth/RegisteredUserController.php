<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Vehicles;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\Category;
use App\Models\Relation;
class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $category = Category::query()
        ->get();
        return view('driver.register',compact('category'));
    }


    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'phone' => [ 'required','max:255', 'unique:'.User::class],
            'car_type' => ['required' ],
            'color' => ['required', 'string'],
            'model' => ['required', 'string', 'max:255'],
            'car_number' => ['required', 'string', 'max:255','unique:'.Vehicles::class],
            // 'password' => ['required', ],
        ]);
        $category = Category::query()
        ->where('id',$request->car_type)
        ->first();


        $number = str_split($request->car_number);
        $pass = [];
        for ($i = count($number)  - 4 ;  $i < count($number); $i++) {
            $pass[] = $number[$i];
        }
        $pass = implode('', $pass);
        $pass2 = str_replace(' ', '', $category->type);

        $password = $pass2.'@'.$pass;
        // dd($password);

        $user = User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($password),
            // 'password' =>  $password
        ]);

        $vehicle = Vehicles::query()
        ->create([
            'vehicle_name' => $request->model,
            'car_number' => $request->car_number,
            'color' => $request->color,
            'category_id' =>$request->car_type,

        ]);

         Relation::create([
            'driver_id' =>  $user->id,
            'category_id' => $request->car_type,
            'vehicle_id' =>  $vehicle->id,

        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
