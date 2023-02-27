<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Qrcode;
class QueueController extends Controller
{
    function test() {
        $code = null;
        return view('admin.test2',compact('code'));
    }
    function test2() {
        $code = null;
        return view('test2',compact('code'));
    }
    function code() {
        $code = Qrcode::query()
        ->first();
        return json_encode($code);
    }
    public function qrcode(request $request){

        $code = $request->code;
        if($code == null){
            // dd($qrcode);

            return view('admin.qrcode',compact('code'));
        }
       $code = Qrcode::query()
            ->delete();

            Qrcode::query()
            ->create([
                'qrcode'=> $request->code
            ]);

        $code = $request->code;
        return view('admin.qrcode',compact('code'));



    }
}
