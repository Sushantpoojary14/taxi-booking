<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Qrcode;

class QueueController extends Controller
{
    function test()
    {
        $code = null;
        return view('admin.test2', compact('code'));
    }
    function test2()
    {
        $client = new \GuzzleHttp\Client();

        $response = $client->request('POST', 'https://control.msg91.com/api/v5/flow/', [
            'body' => '{"template_id":"6406d54ad6fc052a053a3c52","sender":"msgind","short_url":"1","mobiles":"918805778742","VAR1":"hello","VAR2":"VALUE 2"}',
            'headers' => [
                'Authkey' => '391731AO32MxYY6401992cP1',
                'accept' => 'application/json',
                'content-type' => 'application/json',
            ],
        ]);

        echo $response->getBody();
        $code = null;
        return view('test2', compact('code'));
    }
    function code()
    {
        $code = Qrcode::query()
            ->first();
        return json_encode($code);
    }
    public function qrcode(request $request)
    {

        $code = $request->code;
        if ($code == null) {
            // dd($qrcode);

            return view('admin.qrcode', compact('code'));
        }
        $code = Qrcode::query()
            ->delete();

        Qrcode::query()
            ->create([
                'qrcode' => $request->code
            ]);

        $code = $request->code;
        return view('admin.qrcode', compact('code'));



    }
}
