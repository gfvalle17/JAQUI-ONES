<?php

namespace App\Http\Controllers;

use App\Models\Grado;
use App\Models\Paralelo;
use Illuminate\Http\Request;

class ParaleloController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $grados = Grado::with('paralelos')
        ->orderBy('nombre','asc')
        ->get();
        return view('admin.paralelos.index', compact('grados'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Paralelo $paralelo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Paralelo $paralelo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Paralelo $paralelo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Paralelo $paralelo)
    {
        //
    }
}
