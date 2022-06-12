<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Teacher;
use App\Models\TeacherSubject;
use Illuminate\Http\Request;

class TeacherSubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($teacherId)
    {
        //
        $subjects = Subject::where('active', true)->get();

        if (auth('admin')->check()) {
            $teacher = Teacher::with('subjects')->findOrFail($teacherId);
        } else if (auth('school')->check()) {
            $teacher = Teacher::with('subjects')->where('school_id', auth('school')->id())->findOrFail($teacherId);
            if (count($teacher->subjects) > 0) {
                foreach ($subjects as $subject) {
                    $subject->setAttribute('assigned', false);
                    foreach ($teacher->subjects as $teacherSubject) {
                        if ($teacherSubject->id == $subject->id) {
                            $subject->setAttribute('assigned', true);
                        }
                    }
                }
            }
            return response()->view('cms.teachers.teacher-subjects', ['teacher' => $teacher, 'subjects' => $subjects]);
        } else if (auth('teacher')->check()) {
        }
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
    public function store(Request $request, Teacher $teacher)
    {
        //
        $validator = Validator($request->all(), [
            'subject_id' => 'required|exists:subjects,id|numeric'
        ]);

        if (!$validator->fails()) {
            $subject = Subject::findOrFail($request->get('subject_id'));
            $teacher->subjects()->toggle($subject->id);
            return response()->json(['message' => 'Saved successfully'], 200);
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TeacherSubject  $teacherSubject
     * @return \Illuminate\Http\Response
     */
    public function show(TeacherSubject $teacherSubject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TeacherSubject  $teacherSubject
     * @return \Illuminate\Http\Response
     */
    public function edit(TeacherSubject $teacherSubject)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TeacherSubject  $teacherSubject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TeacherSubject $teacherSubject)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TeacherSubject  $teacherSubject
     * @return \Illuminate\Http\Response
     */
    public function destroy(TeacherSubject $teacherSubject)
    {
        //
    }
}
