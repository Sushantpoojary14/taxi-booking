<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Relation;
use App\Models\queue;

class DriverStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        $id = Auth::user()->id;

        $driver = Relation::query()
            ->where('driver_id', $id)
            ->first();

        if ($driver->status == 0) 
        {
         
            return redirect('driver/logout');
        }

        $queue = queue::query()
            ->where('relation_id', $driver->id)
            ->first();

        if ($queue != null ) {

            if ($queue->status == 1) {
            return redirect()->route('driver.queue');
            }
            else{
                return $next($request);
            }
        }
        else{
            return $next($request);
        }


        // return $next($request);

    }

}
