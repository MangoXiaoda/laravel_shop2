<?php

namespace App\Http\Controllers;

use App\Models\UserAddress;
use Illuminate\Http\Request;
use App\Http\Requests\UserAddressRequest;

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

    /**
     * 创建收货地址
     */
    public function create()
    {
        return view('user_addresses.create_and_edit', ['address' => new UserAddress()]);
    }

    
    public function store(UserAddressRequest $req)
    {
        $req->user()->addresses()->create($req->only([
            'province',
            'city',
            'district',
            'address',
            'zip',
            'contact_name',
            'contact_phone',
        ]));

        return redirect()->route('user_addresses.index');
    }


}
