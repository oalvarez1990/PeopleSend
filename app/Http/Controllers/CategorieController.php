<?php

namespace App\Http\Controllers;

use App\Models\Categorie;

use Illuminate\Http\Request;

class CategorieController extends Controller
{
    //CategorieCreate
    public function CategorieCreate(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string',

            ]);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 400);
        }

        Categorie::create([
            'name' => $request->name,
        ]);
        return 'Categorie ' . $request->name . ' Categorie successfully created!!';
    }

    //CategorieUpdate
    public function CategorieUpdate(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required|string',
            ]);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 400);
        }
        Categorie::find($id)->update([
            'name' => $request->name,
        ]);

        return 'Categorie ' . $request->name . ' Categorie successfully updated!!';
    }


    //CategorieDelete
    public function CategorieDelete($id)
    {
        try {
            $categorie = Categorie::findOrFail($id);
            $categorie->delete();
            return 'Categorie with ID ' . $id . ' successfully deleted!';
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 400);
        }
    }


    //All
    public function All()
    {
        return Categorie::all();
    }

    //id
    public function id($id)
    {
        return Categorie::find($id);
    }
}
