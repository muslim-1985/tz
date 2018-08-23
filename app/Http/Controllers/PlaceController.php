<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomException;
use App\Place;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $geoData = Place::orderBy('address')->get();
        return view('theme.pages.charts', compact('geoData'));
    }
    /**
     * Sort geo data.
     * @param  \Illuminate\Http\Request  $request
     * @param \GuzzleHttp\Client $client
     * @param Place
     * @return \Illuminate\Http\Response
     */
    public function sortGeoData (Client $client, Request $request, Place $place)
    {
        $geoData = Place::orderBy('address')->get();
        if(!empty($geoData)) {
            $geoDataDistance = $place->getGeoDataDistance($geoData, $client, $request);
            $sortGeoData = $place->sortGeoData($geoDataDistance);
        }
        else throw new CustomException('Нет данных для обработки');


        $area = $request->input('sort');

        return view('theme.pages.sort', compact('sortGeoData', 'area', 'geoData'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeGeoData(Request $request)
    {
        $request->validate ([
            'address' => 'required|max:255',
            'lat' => 'required|numeric',
            'lng' => 'required|numeric'
        ]);
        try {
            Place::create($request->all());
            return response()->json(['message' => 'Геоданные успешно сохранены']);
        } catch (\Exception $e) {
            return response()->json(['message'=>$e]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function editGeoData($id)
    {
        $geoData = Place::orderBy('address')->get();
        $place = Place::find($id);
        return view('theme.pages.edit',compact('geoData','place'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function updateGeoData(Request $request, $id)
    {
        $request->validate ([
            'address' => 'required|max:255',
            'lat' => 'required|numeric',
            'lng' => 'required|numeric'
        ]);
        try {
            Place::find($id)->update($request->all());
            return response()->json(['message' => 'Геоданные успешно обновленны']);
        } catch (\Exception $e) {
            return response()->json(['message'=>$e]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyGeoData($id)
    {
        Place::find($id)->delete();
        return redirect('geodata');
    }
}
