<?php

namespace App\Http\Controllers;

use App\Events\UserRegistered;
use App\Models\Peoplesend;
use App\Http\Requests\PeoplesendRequest;
use App\Models\User;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class PeopleSendController extends Controller
{
    //Get all Peoplesend
    public function All()
    {
        return Peoplesend::all();
    }

    //Create Peoplesend
    public function PeoplesendCreate(PeoplesendRequest $request)
    {
        try {
            $request->validated();
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 400);
        }

        Peoplesend::create([
            'id_number' => $request->id_number,
            'names' => $request->names,
            'last_names' => $request->last_names,
            'email' => $request->email,
            'country' => $request->country,
            'address' => $request->address,
            'phone' => $request->phone,
            'id_categorie' => $request->id_categorie,
        ]);
        // Emit event after successful creation of user
        $user = new User($request->all());
        $user->save();
        event(new UserRegistered($user));

        return 'Peoplesend ' . $request->names . ' successfully created!!';
    }

    //Update Peoplesend
    public function PeoplesendUpdate(Request $request)
    {
        $peoplesend = Peoplesend::find($request->id);

        if (!$peoplesend) {
            return response()->json(['error' => 'Peoplesend not found'], 404);
        }

        $peoplesend->update([
            'id_number' => $request->id_number ?? $peoplesend->id_number,
            'names' => $request->names ?? $peoplesend->names,
            'last_names' => $request->last_names ?? $peoplesend->last_names,
            'email' => $request->email ?? $peoplesend->email,
            'country' => $request->country ?? $peoplesend->country,
            'address' => $request->address ?? $peoplesend->address,
            'phone' => $request->phone ?? $peoplesend->phone,
            'id_categorie' => $request->id_categorie ?? $peoplesend->id_categorie,
        ]);

        return 'Peoplesend ' . $peoplesend->names . ' successfully updated!!';
    }

    //Delete Peoplesend
    public function PeoplesendDelete(Request $request)
    {
        $peoplesend = Peoplesend::find($request->id);

        if (!$peoplesend) {
            return response()->json(['error' => 'Peoplesend not found'], 404);
        }

        $peoplesend->delete();

        return 'Peoplesend ' . $peoplesend->names . ' successfully deleted!!';
    }

    //Get Peoplesend by id
    public function id($id)
    {
        $peoplesend = Peoplesend::find($id);

        if (!$peoplesend) {
            return response()->json(['error' => 'Peoplesend not found'], 404);
        }

        return $peoplesend;
    }

    //Get Peoplesend by id_categorie
    public function id_categorie($id_categorie)
    {
        $peoplesend = Peoplesend::where('id_categorie', $id_categorie)->get();

        if (!$peoplesend) {
            return response()->json(['error' => 'Peoplesend not found'], 404);
        }

        return $peoplesend;
    }

    //Get Peoplesend by id_number
    public function id_number($id_number)
    {
        $peoplesend = Peoplesend::where('id_number', $id_number)->get();

        if (!$peoplesend) {
            return response()->json(['error' => 'Peoplesend not found'], 404);
        }

        return $peoplesend;
    }

    //Get Peoplesend by names
    public function names($names)
    {
        $peoplesend = Peoplesend::where('names', $names)->get();

        if (!$peoplesend) {
            return response()->json(['error' => 'Peoplesend not found'], 404);
        }

        return $peoplesend;
    }

    // country 
    public function getCountries()
    {
        $client = new Client();
        $response = $client->get('https://restcountries.com/v3.1/subregion/south America');
        $countries = json_decode($response->getBody(), true);

        $countryNames = [];

        foreach ($countries as $country) {
            $countryNames[] = $country['name']['common'];
        }

        return response()->json($countryNames);
    }

    // 

}
