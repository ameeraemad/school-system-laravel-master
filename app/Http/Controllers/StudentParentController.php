<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\StudentParent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class StudentParentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (auth('admin')->check()) {
            $parents = StudentParent::all();
        } else {
            $parents = StudentParent::whereHas('students', function ($query) {
                $query->where('school_id', auth('school')->user()->id);
            })->get();
        }
        return response()->view('cms.parents.index', ['parents' => $parents]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $cities = City::all();
        return response()->view('cms.parents.create', ['cities' => $cities]);
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
            'city_id' => 'required|exists:cities,id|integer',
            'first_name' => 'required|string|min:3|max:35',
            'last_name' => 'required|string|min:3|max:35',
            'email' => 'required|email|unique:student_parents,email',
            'mobile' => 'required|numeric|unique:student_parents,mobile',
            'gender' => 'required|in:M,F',
            'active' => 'required|boolean',
        ]);

        if (!$validator->fails()) {
            $studentParent = new StudentParent();
            $studentParent->first_name = $request->get('first_name');
            $studentParent->last_name = $request->get('last_name');
            $studentParent->email = $request->get('email');
            $studentParent->mobile = $request->get('mobile');
            $studentParent->gender = $request->get('gender');
            $studentParent->active = $request->get('active');
            $studentParent->city_id = $request->get('city_id');
            $studentParent->password = Hash::make('password');
            $isSaved = $studentParent->save();
            return response()->json(['message' => $isSaved ? "تم الحفظ بنجاح" : "فشلت عملية الحفظ"], $isSaved ? 201 : 400);
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StudentParent  $studentParent
     * @return \Illuminate\Http\Response
     */
    public function show(StudentParent $studentParent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StudentParent  $studentParent
     * @return \Illuminate\Http\Response
     */
    public function edit(StudentParent $studentParent)
    {
        //
        $cities = City::all();
        return response()->view('cms.parents.edit', ['parent' => $studentParent, 'cities' => $cities]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StudentParent  $studentParent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StudentParent $studentParent)
    {
        //
        $validator = Validator($request->all(), [
            'city_id' => 'required|exists:cities,id|integer',
            'first_name' => 'required|string|min:3|max:35',
            'last_name' => 'required|string|min:3|max:35',
            'email' => 'required|email|unique:student_parents,email,' . $studentParent->id,
            'mobile' => 'required|numeric|unique:student_parents,mobile,' . $studentParent->id,
            'gender' => 'required|in:M,F',
            'active' => 'required|boolean',
        ]);

        if (!$validator->fails()) {
            $studentParent->first_name = $request->get('first_name');
            $studentParent->last_name = $request->get('last_name');
            $studentParent->email = $request->get('email');
            $studentParent->mobile = $request->get('mobile');
            $studentParent->gender = $request->get('gender');
            $studentParent->active = $request->get('active');
            $studentParent->city_id = $request->get('city_id');
            $isSaved = $studentParent->save();
            return response()->json(['message' => $isSaved ? "تم الحفظ بنجاح" : "فشلت عملية الحفظ"], $isSaved ? 201 : 400);
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StudentParent  $studentParent
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudentParent $studentParent)
    {
        //
        $isDeleted = $studentParent->delete();
        return response()->json(['message' => $isDeleted ? 'Deleted successfully' : 'Failed to delete'], $isDeleted ? 200 : 400);
    }
}
