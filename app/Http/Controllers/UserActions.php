<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notes;

class UserActions extends Controller
{
    public function createNote(Request $request){

        $request->validate([
            'name' => 'string|required'
        ]);

        $name = $request->name;
        if(empty($name) || null == $name){
            return response()->json(['error', 'Unexpected response.'], 401);
        }
        else{
            $note = Notes::create([
                'name' => $name,
                'content' => '',
                'timestamp' => time()
            ]);

            if($note){
                return response()->json(['ok' => true, 'data' => $note], 200);
            }
            else{
                return response()->json(['error' => 'Error processing data.'], 500);
            }
        }
    }

    public function delete($id){
        if(empty($id)){
            return response()->json(['error' => 'Unexpected response.'], 500);
        }
        else{
            $delete = Notes::where('id', $id)->delete();

            return response()->json([$delete], 200);
        }
    }

    public function updateNote(Request $request){
        $request->validate([
            'id' => 'integer|required',
            'content' => 'string|required'
        ]);

        $id = $request->id;
        $content = $request->content;

        if(empty($id) || empty($content)){
            return response()->json(['error' => 'Unexpected response.'], 500);
        }
        else{
            $notes = Notes::where('id', $id)->update([
                'content' => $content 
            ]);

            return response()->json([$notes], 200);
        }
    }
}
