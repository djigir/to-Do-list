<?php

namespace App\Http\Controllers;



class BaseController extends Controller {

    /**
     * @param null $code
     * @param null $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function responseJSON($code = null, $message = null){

        return response()->json(['status' => $code, 'msg' => $message]);
    }
}
