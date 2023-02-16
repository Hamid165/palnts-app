<?php

namespace App\Http\Controllers;

use App\Models\Plant;
use Illuminate\Http\Request;

class plantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plant = Plant::all();

        return response()->json([
            "message" => "data ditampilkan",
            "data" => $plant
        ], 200);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $filename = time() . '_' . $image->getClientOriginalName();
            $filepath = $image->storeAs('public/images', $filename);

            // simpan informasi file ke database
            $data = [
                
                'gambar' => $filepath,
                'deskripsi' => $request->input('deskripsi'), // ambil deskripsi dari input form
                // tambahkan field lain yang ingin disimpan
            ];

            Plant::create($data);

            return response()->json(['message' => 'File berhasil diupload']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Plant::findOrFail($id);
        $delete->delete();

        return
        response()->json([
            "message" => "foto didihapus",
            "data" => $delete
        ], 200);
    }
}
