<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\School;
use App\Models\Student;
use App\Models\StudentParent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
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
            $students = Student::with(['city', 'parent', 'school'])->get();
        } else {
            $students = Student::with(['city', 'parent', 'school'])
                ->where('school_id', auth('school')->user()->id)
                ->get();
        }
        return response()->view('cms.students.index', ['students' => $students]);
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
        $parents = StudentParent::where('active', true)->get();

        return response()->view('cms.students.create', ['cities' => $cities, 'schools' => $schools, 'parents' => $parents]);
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
            'parent_id' => 'required|integer|exists:student_parents,id',
            'school_id' => 'required|integer|exists:schools,id',
            'gender' => 'required|string|in:M,F',
            'name' => 'required|string|min:2',
            'email' => 'required|email|unique:students,email',
            'mobile' => 'nullable|numeric|unique:students,mobile',
            'birth_date' => 'nullable|date',
            'active' => 'required|boolean'
        ]);

        if (!$validator->fails()) {
            $student = new Student();
            $student->name = $request->get('name');
            $student->email = $request->get('email');
            $student->mobile = $request->get('mobile');
            $student->birth_date = $request->get('birth_date');
            $student->active = $request->get('active');
            $student->city_id = $request->get('city_id');
            $student->parent_id = $request->get('parent_id');
            $student->school_id = $request->get('school_id');
            $student->password = Hash::make("password");
            $isSaved = $student->save();
            return response()->json(['message' => $isSaved ? "تم الحفظ بنجاح" : "فشلت عملية الحفظ"], $isSaved ? 201 : 400);
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], 400);;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //
        if (auth('admin')->check()) {
            $schools = School::where('active', true)->get();
        } else {
            $schools = [auth('school')->user()];
        }
        $cities = City::where('active', true)->get();
        $parents = StudentParent::where('active', true)->get();

        return response()->view('cms.students.edit', ['student' => $student, 'cities' => $cities, 'schools' => $schools, 'parents' => $parents]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        //
        $validator = Validator($request->all(), [
            'city_id' => 'required|integer|exists:cities,id',
            'parent_id' => 'required|integer|exists:student_parents,id',
            'school_id' => 'required|integer|exists:schools,id',
            'gender' => 'required|string|in:M,F',
            'name' => 'required|string|min:2',
            'email' => 'required|email|unique:students,email,' . $student->id,
            'mobile' => 'nullable|numeric|unique:students,mobile,' . $student->id,
            'birth_date' => 'nullable|date',
            'active' => 'required|boolean'
        ]);

        if (!$validator->fails()) {
            $student->name = $request->get('name');
            $student->email = $request->get('email');
            $student->mobile = $request->get('mobile');
            $student->birth_date = $request->get('birth_date');
            $student->active = $request->get('active');
            $student->city_id = $request->get('city_id');
            $student->parent_id = $request->get('parent_id');
            $student->school_id = $request->get('school_id');
            $isSaved = $student->save();
            return response()->json(['message' => $isSaved ? "تم الحفظ بنجاح" : "فشلت عملية الحفظ"], $isSaved ? 201 : 400);
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], 400);;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        //
        $isDeleted = $student->delete();
        return response()->json(['message' => $isDeleted ? "تم الحذف بنجاح" : "فشلت عملية الحذف"], $isDeleted ? 200 : 400);
    }
}
