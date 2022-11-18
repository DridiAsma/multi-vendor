<?php

namespace App\Http\Controllers;

use App\Models\Prouduct;
use App\Http\Requests\StoreProuductRequest;
use App\Http\Requests\UpdateProuductRequest;

class ProuductController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProuductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProuductRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Prouduct  $prouduct
     * @return \Illuminate\Http\Response
     */
    public function show(Prouduct $prouduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Prouduct  $prouduct
     * @return \Illuminate\Http\Response
     */
    public function edit(Prouduct $prouduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProuductRequest  $request
     * @param  \App\Models\Prouduct  $prouduct
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProuductRequest $request, Prouduct $prouduct)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Prouduct  $prouduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prouduct $prouduct)
    {
        //
    }
}
