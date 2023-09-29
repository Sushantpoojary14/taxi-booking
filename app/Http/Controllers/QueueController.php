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
        return view('admin.test', compact('code'));
    }
    function test2()
    {
        $client = new \GuzzleHttp\Client();

        $response = $client->request('POST', 'https://control.msg91.com/api/v5/flow/', [
            'body' => '{"template_id":"640b271cd6fc052d317ae6b2","sender":"aUtoFu","short_url":"1","mobiles":"918805778742","VAR1":"hello","VAR2":"VALUE 2"}',
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

     function qrcodeapi(request $request)
    {
        $code = Qrcode::query()

        ->updateOrInsert(
            ['id'=> 1 ],
            ['qrcode' =>$request->input('code')]
        );
        return response()->json([
        'success' => $code
        ]);
    }

    function get_qrcodeapi(request $request)
    {
        $code = Qrcode::query()->first();
        return response()->json(
        $code
        );
    }

    public function qrcode(request $request)
    {

        return view('admin.qrcode');

    }
}
