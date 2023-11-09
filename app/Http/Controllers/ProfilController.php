<?php

namespace App\Http\Controllers;

use App\Models\Profil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
           $profil = Profil::all();
           return view('tableau',compact('profil') );


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('index');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        //dd($request->all()); //
        Profil::create([
            'username'=>$request->username, 
            'password'=>Hash::make($request->password),
            'lastname'=>$request->lastname, 
            'email'=>$request->email, 
            'birthday'=>$request->birthday, 
            'role'=>$request->role, 
        ]);

        return redirect(route ('profils.index') );

    }

    /**
     * Display the specified resource.
     */
    public function show(Profil $profil)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profil $profil)
    {
        //
        return view('edit',compact('profil') );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Profil $profil)
    {
        //
         
        $request->validate([
            'lastname' => 'required|string',
            'username' => 'required|string' ,
            'birthday' => 'required|date'    ,    ]);


        $profil->update([
            'lastname' => $request->input('lastname'),
            'username' => $request->input('username'),
            'birthday'  => $request->input('birthday'),
        ]);

        
        return redirect()->route('profils.index')->with('success', 'Profil modifié avec succès');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profil $profil)
    {
        //
            $profil->delete();
            return redirect()-> route('profils.index');

    }
}
