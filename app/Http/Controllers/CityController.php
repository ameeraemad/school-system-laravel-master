<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = City::all();
        return response()->view('cms.cities.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return response()->view('cms.cities.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator($request->all(), [
            'name' => 'required|string|max:35',
            'active' => 'boolean'
        ]);
        if (!$validator->fails()) {
            $city = new City();
            $city->name = $request->get('name');
            $city->active = $request->get('active');
            $isSaved = $city->save();
            return response(['status' => $isSaved, 'message' => $isSaved ? "تمت العملية بنجاح" : "فشلت العملية"], $isSaved ? 200 : 400);
        } else {
            return response(['status' => false, 'message' => $validator->getMessageBag()->first()], 400);
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
    public function edit(City $city)
    {
        //
        return response()->view('cms.cities.edit', ['city' => $city]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, City $city)
    {
        //
        $validator = Validator($request->all(), [
            'name' => 'required|string|max:35',
            'active' => 'boolean'
        ]);
        if (!$validator->fails()) {
            $city->name = $request->get('name');
            $city->active = $request->get('active');
            $isSaved = $city->save();
            return response(['status' => $isSaved, 'message' => $isSaved ? "تمت العملية بنجاح" : "فشلت العملية"], $isSaved ? 200 : 400);
        } else {
            return response(['status' => false, 'message' => $validator->getMessageBag()->first()], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        //
        $isDeleted = $city->delete();
        return response(['status' => $isDeleted, 'message' => $isDeleted ? "تمت العملية بنجاح" : "فشلت العملية"], $isDeleted ? 200 : 400);
    }
}
