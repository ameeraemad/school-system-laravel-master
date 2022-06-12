<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\School;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
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
            $teachers = Teacher::withCount('teacherSubjects')->get();
        } else {
            $teachers = Teacher::withCount('teacherSubjects')->where('school_id', auth('school')->user()->id)->get();
        }
        return response()->view('cms.teachers.index', ['teachers' => $teachers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        if (auth('admin')->check()) {
            $schools = School::where('active', true)->get();
        } else {
            $schools = [auth('school')->user()];
        }
        $cities = City::where('active', true)->get();
        return response()->view('cms.teachers.create', ['cities' => $cities, 'schools' => $schools,]);
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
            'city_id' => 'required|integer|exists:cities,id',
            'school_id' => 'required|integer|exists:schools,id',
            'gender' => 'required|string|in:M,F',
            'name' => 'required|string|min:2',
            'email' => 'required|email|unique:teachers,email',
            'mobile' => 'nullable|numeric|unique:teachers,mobile',
            'birth_date' => 'nullable|date',
            'active' => 'required|boolean'
        ]);

        if (!$validator->fails()) {
            $teacher = new Teacher();
            $teacher->name = $request->get('name');
            $teacher->email = $request->get('email');
            $teacher->mobile = $request->get('mobile');
            $teacher->birth_date = $request->get('birth_date');
            $teacher->active = $request->get('active');
            $teacher->city_id = $request->get('city_id');
            $teacher->school_id = $request->get('school_id');
            $teacher->password = Hash::make("password");
            $isSaved = $teacher->save();
            return response()->json(['message' => $isSaved ? "تم الحفظ بنجاح" : "فشلت عملية الحفظ"], $isSaved ? 201 : 400);
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], 400);;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit(Teacher $teacher)
    {
        //
        if (auth('admin')->check()) {
            $schools = School::where('active', true)->get();
        } else {
            $schools = [auth('school')->user()];
        }
        $cities = City::where('active', true)->get();
        return response()->view('cms.teachers.edit', ['teacher' => $teacher, 'cities' => $cities, 'schools' => $schools,]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teacher $teacher)
    {
        //
        $validator = Validator($request->all(), [
            'city_id' => 'required|integer|exists:cities,id',
            'school_id' => 'required|integer|exists:schools,id',
            'gender' => 'required|string|in:M,F',
            'name' => 'required|string|min:2',
            'email' => 'required|email|unique:teachers,email,' . $teacher->id,
            'mobile' => 'nullable|numeric|unique:teachers,mobile,' . $teacher->id,
            'birth_date' => 'nullable|date',
            'active' => 'required|boolean'
        ]);

        if (!$validator->fails()) {
            $teacher->name = $request->get('name');
            $teacher->email = $request->get('email');
            $teacher->mobile = $request->get('mobile');
            $teacher->birth_date = $request->get('birth_date');
            $teacher->active = $request->get('active');
            $teacher->city_id = $request->get('city_id');
            $teacher->school_id = $request->get('school_id');
            $isSaved = $teacher->save();
            return response()->json(['message' => $isSaved ? "تم الحفظ بنجاح" : "فشلت عملية الحفظ"], $isSaved ? 201 : 400);
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], 400);;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $teacher)
    {
        //
        $isDeleted = $teacher->delete();
        return response()->json(['message' => $isDeleted ? "Deleted successfully" : "Failed to delete"], $isDeleted ? 200 : 400);
    }
}
