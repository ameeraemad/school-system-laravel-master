<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::all();
        return response()->view('cms.admins.index', ['admins' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $roles = Role::where('guard_name', 'admin')->get();
        $cities = City::all();
        return response()->view('cms.admins.create', ['cities' => $cities, 'roles' => $roles]);
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
            'city_id' => 'required|exists:cities,id',
            'name' => 'required|string|min:3|max:35',
            'email' => 'required|email|unique:users',
            'mobile' => 'required|numeric|unique:users',
            'gender' => 'required|string|min:M,F',
            'active' => 'required|boolean'
        ]);

        if (!$validator->fails()) {
            $role = Role::findById($request->get('role_id'), 'admin');

            $user = new User();
            $user->name = $request->get('name');
            $user->email = $request->get('email');
            $user->mobile = $request->get('mobile');
            $user->active = $request->get('active');
            $user->gender = $request->get('gender');
            $user->city_id = $request->get('city_id');
            $user->password = Hash::make("password");
            $isSaved = $user->save();
            $user->assignRole($role);
            return response()->json(['message' => $isSaved ? "تم الحفظ ينجاح" : "فشلت عملية الحفظ"], $isSaved ? 201 : 400);
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
    public function edit(User $user)
    {
        //
        $roles = Role::where('guard_name', 'admin')->get();
        $cities = City::all();
        return response()->view('cms.admins.edit', [
            'cities' => $cities, 'roles' => $roles, 'admin' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
        $validator = Validator($request->all(), [
            'role_id' => 'required|exists:roles,id',
            'city_id' => 'required|exists:cities,id',
            'name' => 'required|string|min:3|max:35',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'mobile' => 'required|numeric|unique:users,mobile,' . $user->id,
            'gender' => 'required|string|min:M,F',
            'active' => 'required|boolean'
        ]);

        if (!$validator->fails()) {
            $role = Role::findById($request->get('role_id'), 'admin');

            $user->name = $request->get('name');
            $user->email = $request->get('email');
            $user->mobile = $request->get('mobile');
            $user->active = $request->get('active');
            $user->gender = $request->get('gender');
            $user->city_id = $request->get('city_id');
            $isSaved = $user->save();
            $user->syncRoles([$role]);
            return response()->json(['message' => $isSaved ? "تم التعديل ينجاح" : "فشلت عملية التعديل"], $isSaved ? 201 : 400);
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
        $isDeleted = $user->delete();
        return response()->json(['message' => $isDeleted ? "تم الحذف بنجاح" : "فشلت عملية الحذف"], $isDeleted ? 200 : 400);
    }
}
