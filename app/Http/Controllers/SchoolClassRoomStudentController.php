<?php

namespace App\Http\Controllers;

use App\Models\SchoolClassRoom;
use App\Models\SchoolClassRoomStudent;
use App\Models\Student;
use Illuminate\Http\Request;

class SchoolClassRoomStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SchoolClassRoom $schoolClassRoom)
    {
        //
        $students = Student::where('school_id', auth('school')->id())->get();

        $classRoomStudents = $schoolClassRoom->classRoomStudents;
        $schoolClassRoom = $schoolClassRoom->load('classRoom');
        foreach ($students as $student) {
            $student->setAttribute('assigned', false);
            foreach ($classRoomStudents as $classRoomStudent) {
                if ($student->id == $classRoomStudent->student_id) {
                    $student->setAttribute('assigned', true);
                }
            }
        }
        return response()->view('cms.school-class-rooms.class-room-students', [
            'schoolClassRoom' => $schoolClassRoom, 'students' => $students
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, SchoolClassRoom $schoolClassRoom)
    {
        //
        $validator = Validator($request->all(), [
            'student_id' => 'required|exists:students,id|numeric'
        ]);

        if (!$validator->fails()) {
            $student = Student::where('school_id', auth('school')->user()->id)->findOrFail($request->get('student_id'));
            $schoolClassRoom->students()->toggle($student->id);
            return response()->json(['message' => 'Success'], 200);
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SchoolClassRoomStudent  $schoolClassRoomStudent
     * @return \Illuminate\Http\Response
     */
    public function show(SchoolClassRoomStudent $schoolClassRoomStudent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SchoolClassRoomStudent  $schoolClassRoomStudent
     * @return \Illuminate\Http\Response
     */
    public function edit(SchoolClassRoomStudent $schoolClassRoomStudent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SchoolClassRoomStudent  $schoolClassRoomStudent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SchoolClassRoomStudent $schoolClassRoomStudent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SchoolClassRoomStudent  $schoolClassRoomStudent
     * @return \Illuminate\Http\Response
     */
    public function destroy(SchoolClassRoomStudent $schoolClassRoomStudent)
    {
        //
    }
}
