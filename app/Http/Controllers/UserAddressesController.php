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

    /**
     * 添加收货地址
     */
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

    /**
     * 修改地址页面
     */
    public function edit(UserAddress $user_address)
    {   
        $this->authorize('own', $user_address);

        return view('user_addresses.create_and_edit', ['address' => $user_address]);
    }

    /**
     * 修改地址
     */
    public function update(UserAddress $user_address, UserAddressRequest $req)
    {
        $this->authorize('own', $user_address);

        $user_address->update($req->only([
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

    /**
     * 删除地址
     */
    public function destroy(UserAddress $user_address)
    {   
        $this->authorize('own', $user_address);

        $user_address->delete();

        return [];
    }

}
