<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\SendEmail;

class EmailController extends Controller
{
    // TODO: finish implementing send method
    public function send(Request $request)
    {
        $data = $request->json()->all();
        if (!empty($data)) {
            SendEmail::dispatch($data);
        } else {
            return response()->json(['message' => 'Data should not be empty']);
        }
    }

    //  TODO - BONUS: implement list method
    public function list()
    {

    }
}
