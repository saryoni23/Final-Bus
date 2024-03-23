<?php

namespace App\Http\Controllers;

use App\Models\Transportasi;
use Illuminate\Http\Request;

class TransportasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.transportasi.index', [
            'transportasi' => Transportasi::all()
        ]);
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
        $validatedData = $request->validate([
            'name' => ['required', 'min:3', 'max:50'],
            'kode' => ['required', 'min:3', 'max:10'],
        ]);

        $check = Transportasi::where('name', $validatedData['name'])->first();

        if ($check) {
            return redirect('/transportasi')->with('Transportasi', 'Transportasi tersebut sudah ada di database!');
        }

        Transportasi::create($validatedData);

        return redirect('/transportasi')->with('store', 'Data Transportasi Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transportasi $transportasis)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'min:3', 'max:50'],
            'kode' => ['required', 'min:3', 'max:10'],
        ]);

        $check = Transportasi::where('id', '!=', $transportasis->id)->where('name', $validatedData['name'])->where('kode', $validatedData['kode'])->first();

        if ($check) {
            return redirect('/transportasi')->with('Transportasi', 'Transportasi tersebut sudah ada di database!');
        }

        $transportasis->update($validatedData);

        return redirect('/transportasi')->with('update', 'Data Transportasi Berhasil Diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transportasi $transportasi)
    {
        $transportasi->delete();
        return redirect('/transportasi')->with('delete', 'Data transportasi Berhasil Dihapus');
    }
}
