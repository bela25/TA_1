<?php

namespace App\Http\Controllers;

use App\Feedback;
use App\Pegawai;
use App\Customer;
use App\Lokasi;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $feedbacks=Feedback::all();
        return view('feedback.index',compact('feedbacks'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pegawais=Pegawai::all();
        $customers=Customer::all();
        $lokasis=Lokasi::all();
        return view('feedback.create',compact('pegawais','customers','lokasis'));
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
        $post = new Feedback();
        $post ->tanggal_feedback = $request->get('tanggal_feedback');
        $post ->isi = $request->get('isi');
        // $post ->reply = $request->get('reply');
        $post ->reply = date('Y-m-d');
        $post ->pegawai = $request->get('pegawai');
        $post ->customer = $request->get('customer');
        $post ->lokasi = $request->get('lokasi');
        $post->save();
        return redirect('feedbacks');
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function show(Feedback $feedback)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function edit(Feedback $feedback)
    {
        $pegawais=Pegawai::all();
        $customers=Customer::all();
        $lokasis=Lokasi::all();
        return view('feedback.update',compact('feedback','pegawais','customers','lokasis'));
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Feedback $feedback)
    {
        $feedback ->tanggal_feedback = $request->get('tanggal_feedback');
        $feedback ->isi = $request->get('isi');
        // $feedback ->reply = $request->get('reply');
        $feedback ->pegawai = $request->get('pegawai');
        $feedback ->customer = $request->get('customer');
        $feedback ->lokasi = $request->get('lokasi');
        $feedback->save();
        return redirect('feedbacks');
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function destroy(Feedback $feedback)
    {
        $feedback->delete();
        return redirect('feedbacks');
        //
    }
}
