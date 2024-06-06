<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Beautician;

class BeauticianController extends Controller
{
    public function index(){
        $beautician = Beautician::get();
        return view('beautician.index', compact('beautician'));
    }

    public function create(){
        return view('beautician.create');
    }
    public function store(Request $request){
        $beautician = new Beautician;
        $beautician->name = $request->name;
        $beautician->email = $request->email;
        $beautician->phone = $request->phone;
        $beautician->save();
        return redirect()->route('beautician.index');
    }
    public function edit($id){
        $beautician = Beautician::where('id', $id)->first();
        return view('beautician.edit', compact('beautician'));
    }
    public function update(Request $request, $id){
        $beautician = Beautician::where('id', $id)->first();
        $beautician->name = $request->name;
        $beautician->email = $request->email;
        $beautician->phone = $request->phone;
        $beautician->save();
        return redirect()->route('beautician.index'); 
    }
}
