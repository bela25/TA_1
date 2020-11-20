<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers=Customer::all();
        return view('customer.index',compact('customers'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customer.create');
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = new User();
        $user->name = $request->get('nama');
        $user->email = $request->get('email');
        $user->password = bcrypt($request->get('password'));
        $user->save();

        $post = new Customer();
        $post ->nama = $request->get('nama');
        $post ->alamat = $request->get('alamat');
        $post ->no_telp = $request->get('notelp');
        $post ->no_ktp = $request->get('noktp');
        // $post ->tempat_lahir = $request->get('tempatlahir');
        $post ->tgl_lahir = $request->get('tgllahir');
        $post ->gender = $request->get('customRadio');
        $post ->user_id = $user->id;
        $post->save();
        return redirect('customers');
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        return view('customer.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        return view('customer.update',compact('customer'));
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
        ]);

        $user->name = $request->get('nama');
        $user->email = $request->get('email');
        $user->save();

        $customer ->nama = $request->get('nama');
        $customer ->alamat = $request->get('alamat');
        $customer ->no_telp = $request->get('notelp');
        $customer ->no_ktp = $request->get('noktp');
        // $customer ->tempat_lahir = $request->get('tempatlahir');
        $customer ->tgl_lahir = $request->get('tgllahir');
        $customer ->gender = $request->get('gender');
        $customer->save();
        return redirect('customers');
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $user = $customer->user;
        $customer->delete();
        $user->delete();
        return redirect('customers');
        //
    }
}
