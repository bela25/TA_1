<?php

namespace App\Http\Controllers;

use App\Verifikasi;
use App\Customer;
use Illuminate\Http\Request;

class VerifikasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pengunjung.verifikasi.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $customer=auth()->user()->customer;

        $verifikasi= new Verifikasi();
        $verifikasi->customer=$customer->idcustomers;
        $verifikasi->tanggal=date('Y-m-d');
        $verifikasi->status=$request->get('status');
        // ktp
        $file = $request->file('ktp');
        $nama_gambar = $file->move('verifikasi/', $file->getClientOriginalName());
        $verifikasi->ktp=$nama_gambar;
        // kk
        $file = $request->file('kk');
        $nama_gambar = $file->move('verifikasi/', $file->getClientOriginalName());
        $verifikasi->kk=$nama_gambar;
        // npwp
        $file = $request->file('npwp');
        $nama_gambar = $file->move('verifikasi/', $file->getClientOriginalName());
        $verifikasi->npwp=$nama_gambar;
        $verifikasi->save();
        return redirect('profil');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Verifikasi  $verifikasi
     * @return \Illuminate\Http\Response
     */
    public function show(Verifikasi $verifikasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Verifikasi  $verifikasi
     * @return \Illuminate\Http\Response
     */
    public function edit(Verifikasi $verifikasi)
    {
        return view('pengunjung.verifikasi.edit', compact('verifikasi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Verifikasi  $verifikasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Verifikasi $verifikasi)
    {
        $verifikasi->tanggal=date('Y-m-d');
        $verifikasi->status=$request->get('status');
        // ktp
        $file = $request->file('ktp');
        if(isset($file))
        {
            if(isset($verifikasi->ktp))
            {
                unlink(public_path($verifikasi->ktp));
            }
            $nama_gambar = $file->move('verifikasi/', $file->getClientOriginalName());
            $verifikasi ->ktp = $nama_gambar;
        }
        // kk
        $file = $request->file('kk');
        if(isset($file))
        {
            if(isset($verifikasi->kk))
            {
                unlink(public_path($verifikasi->kk));
            }
            $nama_gambar = $file->move('verifikasi/', $file->getClientOriginalName());
            $verifikasi ->kk = $nama_gambar;
        }
        // npwp
        $file = $request->file('npwp');
        if(isset($file))
        {
            if(isset($verifikasi->npwp))
            {
                unlink(public_path($verifikasi->npwp));
            }
            $nama_gambar = $file->move('verifikasi/', $file->getClientOriginalName());
            $verifikasi ->npwp = $nama_gambar;
        }
        $verifikasi->save();
        return redirect('profil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Verifikasi  $verifikasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Verifikasi $verifikasi)
    {
        $verifikasi->delete();
        return redirect('profil');
    }

    public function verifikasi(Request $request, Verifikasi $verifikasi)
    {
        if($request->get('aksi') == 'diterima')
        {
            $verifikasi->tgl_diterima=date('Y-m-d');
        }
        else
        {
            $verifikasi->tgl_diterima=null;
        }
        $verifikasi->save();
        return redirect('customers/'.$verifikasi->customer);
    }
}
