<?php

namespace App\Http\Controllers;

use App\Models\Galery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;


class GaleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $galeries = Galery::orderBy('id', 'DESC')->where('user_id', Session::get('user_id'))->get();
        return view('index', compact('galeries'));
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
        $val = $request->validate([
            'judul'=>'required',
            'deskripsi'=>'required',
            'photo'=>'required',
        ]);
        if ($request->hasFile('photo'))
        {
            $filePath = Storage::disk('public')->put('images/posts/',request()->file('photo'));
            $val['photo']=$filePath;
        }
        $create =Galery::create([
            'judul'=>$val['judul'],
            'deskripsi'=>$val['deskripsi'],
            'photo'=>$val['photo'],
            'user_id'=>Session::get('user_id'),
        ]);
        if ($create)
        {
           return redirect('/galery')->with('alert', 'Berhasil Dibuat');
        }
        return abort(500);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Galery  $galery
     * @return \Illuminate\Http\Response
     */
    public function show(Galery $galery)
    {
        //
    }
 
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Galery  $galery
     * @return \Illuminate\Http\Response
     */
    public function edit(Galery $galery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Galery  $galery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Galery $galery)
    {
        if ($request->hasFile('photo'))
        {
            $filePath = Storage::disk('public')->put('images/posts/',request()->file('photo'));
            
            $galery->judul=$request->judul;
            $galery->deskripsi=$request->deskripsi;
            $galery->photo=$filePath;
            $galery->user_id=Session::get('user_id');
            $galery->save();
        } else {
            $galery->judul=$request->judul;
            $galery->deskripsi=$request->deskripsi;
            $galery->photo=$galery->photo;
            $galery->user_id=Session::get('user_id');
            $galery->save();
        }
        return redirect('/galery')->with('alert', 'Berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Galery  $galery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Galery $galery)
    {
        $galery->delete();
        return redirect('/galery');
    }
}
