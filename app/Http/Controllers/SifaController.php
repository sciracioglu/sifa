<?php

namespace App\Http\Controllers;

use App\Sifa;
use Illuminate\Http\Request;

class SifaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kitaplar = Sifa::get();

        return view('welcome', compact('kitaplar'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Sifa::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sifa  $sifa
     * @return \Illuminate\Http\Response
     */
    public function show(Sifa $sifa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sifa  $sifa
     * @return \Illuminate\Http\Response
     */
    public function edit(Sifa $sifa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sifa  $sifa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sifa $sifa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sifa  $sifa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sifa $sifa)
    {
        //
    }
}
