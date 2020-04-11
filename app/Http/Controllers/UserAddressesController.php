<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserAddressesController extends Controller
{
    /**
     * 地址首页
     */
    public function index(Request $req)
    {   
        return view('user_addresses.index', [
            'addresses' => $req->user()->addresses
        ]);
    }

}
