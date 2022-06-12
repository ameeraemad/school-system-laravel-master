<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $schools = School::with('city')->get();
        return response()->view('cms.schools.index', ['schools' => $schools]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $roles = Role::where('guard_name', 'school')->get();
        $cities = City::all();
        return response()->view('cms.schools.create', ['cities' => $cities, 'roles' => $roles]);
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
            'role_id' => 'required|exists:roles,id',
            'name' => 'required|string|min:3|max:45',
            'email' => 'required|email|unique:schools',
            'telephone' => 'required|numeric|unique:schools',
            'mobile' => 'required|numeric|unique:schools',
            'address' => 'required|string',
            'gender' => 'required|in:M,F,MF',
            'city_id' => 'required|integer|exists:cities,id',
            'active' => 'required|boolean'
        ]);

        if (!$validator->fails()) {
            $role = Role::findById($request->get('role_id'), 'school');

            $school = new School();
            $school->name = $request->get('name');
            $school->email = $request->get('email');
            $school->telephone = $request->get('telephone');
            $school->mobile = $request->get('mobile');
            $school->address = $request->get('address');
            $school->gender = $request->get('gender');
            $school->city_id = $request->get('city_id');
            $school->active = $request->get('active');
            $school->password = Hash::make('password');
            $isSaved = $school->save();
            $school->assignRole($role);
            return response()->json(['message' => $isSaved ? 'تم حفظ العنصر بنجاح' : 'فشل عملية الحفظ'], $isSaved ? 201 : 400);
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], 400);
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
        $roles = Role::where('guard_name', 'school')->get();
        $school = School::findOrFail($id);
        $cities = City::all();
        return response()->view('cms.schools.edit', ['school' => $school, 'roles' => $roles, 'cities' => $cities]);
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
        $validator = Validator($request->all(), [
            'role_id' => 'required|exists:roles,id',
            'name' => 'required|string|min:3|max:45',
            'email' => 'required|email|unique:schools,email,' . $id,
            'telephone' => 'required|numeric|unique:schools,telephone,' . $id,
            'mobile' => 'required|numeric|unique:schools,mobile,' . $id,
            'address' => 'required|string',
            'gender' => 'required|in:M,F,MF',
            'city_id' => 'required|integer|exists:cities,id',
            'active' => 'required|boolean'
        ]);

        if (!$validator->fails()) {
            $role = Role::findById($request->get('role_id'), 'school');

            $school = School::findOrFail($id);
            $school->name = $request->get('name');
            $school->email = $request->get('email');
            $school->telephone = $request->get('telephone');
            $school->mobile = $request->get('mobile');
            $school->address = $request->get('address');
            $school->gender = $request->get('gender');
            $school->city_id = $request->get('city_id');
            $school->active = $request->get('active');
            $isSaved = $school->save();
            $school->syncRoles([$role]);
            return response()->json(['message' => $isSaved ? 'تم حفظ العنصر بنجاح' : 'فشل عملية الحفظ'], $isSaved ? 200 : 400);
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $isDestroyed = School::destroy($id);
        return response()->json(['message' => $isDestroyed ? 'تم الحذف بنجاح' : 'فشلت عملية الحذف'], $isDestroyed ? 200 : 400);
    }
}
