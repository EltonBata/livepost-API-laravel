<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreComentRequest;
use App\Http\Requests\UpdateComentRequest;
use App\Models\Coment;

class ComentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreComentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Coment $coment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateComentRequest $request, Coment $coment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coment $coment)
    {
        //
    }
}
