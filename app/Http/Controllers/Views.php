<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notes;

class Views extends Controller
{
    public function notes(Request $request, $id = ''){
        $id = $id ? $id : $request->id;

        if($id = '' || null == session('user')){
            $notes = Notes::all()->orderBy('timestamp', 'DESC');

            return response()->json([$notes], 200);
        }
        else{
            $user_id = session('user')->id;

            $notes = Notes::where('user', $user_id)->get();

            return response()->json([$notes], 200);
        }
    }
}
