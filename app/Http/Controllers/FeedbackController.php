<?php

namespace App\Http\Controllers;

use App\Feedback;
use App\Pegawai;
use App\Customer;
use App\Lokasi;
use Illuminate\Http\Request;
use App\Classes\PHPInsight\Sentiment;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $sentiment = new Sentiment();
        // $kata = 'pelayanannya sangat cepat dan baik';
        // $scores = $sentiment->score($kata);
        // $class = $sentiment->categorise($kata);
        // dd([$scores,$class]);
        $feedbacks=Feedback::all();
        $pegawai = auth()->user()->pegawai;
        if($pegawai->jabatan == 'marketing')
        {
            $feedbacks = $feedbacks->filter(function ($item, $key) use ($pegawai) {
                return in_array($item->lokasis->idlokasi, $pegawai->lokasipegawais->pluck('lokasi')->toArray());
            });
        }
        $positif = $feedbacks->where('sentimen','positif')->count();
        $negatif = $feedbacks->where('sentimen','negatif')->count();
        $netral = $feedbacks->where('sentimen','netral')->count();
        // dd($sentimen);
        return view('feedback.index',compact('feedbacks','positif','negatif','netral'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $pegawais=Pegawai::all();
        // $customers=Customer::all();
        // $lokasis=Lokasi::all();
        // return view('feedback.create',compact('pegawais','customers','lokasis'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $sentiment = new Sentiment();
        // $scores = $sentiment->score($request->get('isi'));
        // $class = $sentiment->categorise($request->get('isi'));

        // $post = new Feedback();
        // $post ->tanggal_feedback = $request->get('tanggal_feedback');
        // $post ->isi = $request->get('isi');
        // // $post ->reply = $request->get('reply');
        // // $post ->reply = date('Y-m-d');
        // $post ->pegawai = $request->get('pegawai');
        // $post ->customer = $request->get('customer');
        // $post ->lokasi = $request->get('lokasi');
        // $post ->sentimen = $class;
        // $post->save();
        // return redirect('feedbacks');
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
        // $pegawais=Pegawai::all();
        // $customers=Customer::all();
        // $lokasis=Lokasi::all();
        // return view('feedback.update',compact('feedback','pegawais','customers','lokasis'));
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
        // $sentiment = new Sentiment();
        // $scores = $sentiment->score($request->get('isi'));
        // $class = $sentiment->categorise($request->get('isi'));

        // $feedback ->tanggal_feedback = $request->get('tanggal_feedback');
        // $feedback ->isi = $request->get('isi');
        // // $feedback ->reply = $request->get('reply');
        // $feedback ->pegawai = $request->get('pegawai');
        // $feedback ->customer = $request->get('customer');
        // $feedback ->lokasi = $request->get('lokasi');
        // $post ->sentimen = $class;
        // $feedback->save();
        // return redirect('feedbacks');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function destroy(Feedback $feedback)
    {
        // $feedback->delete();
        // return redirect('feedbacks');
    }
}
