<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Subject::all();
        return response()->view('cms.subjects.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return response()->view('cms.subjects.create');
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
            'details' => 'nullable|string|max:100',
            'active' => 'boolean'
        ]);
        if (!$validator->fails()) {
            $subject = new Subject();
            $subject->name = $request->get('name');
            $subject->details = $request->get('details');
            $subject->active = $request->get('active');
            $isSaved = $subject->save();
            return response(['status' => $isSaved, 'message' => $isSaved ? "تمت العملية بنجاح" : "فشلت العملية"], $isSaved ? 200 : 400);
        } else {
            return response(['status' => false, 'message' => $validator->getMessageBag()->first()], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {
        //
        return response()->view('cms.subjects.edit', ['subject' => $subject]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subject $subject)
    {
        //
        $validator = Validator($request->all(), [
            'name' => 'required|string|max:35',
            'details' => 'nullable|string|max:100',
            'active' => 'boolean'
        ]);
        if (!$validator->fails()) {
            $subject->name = $request->get('name');
            $subject->details = $request->get('details');
            $subject->active = $request->get('active');
            $isSaved = $subject->save();
            return response(['status' => $isSaved, 'message' => $isSaved ? "تمت العملية بنجاح" : "فشلت العملية"], $isSaved ? 200 : 400);
        } else {
            return response(['status' => false, 'message' => $validator->getMessageBag()->first()], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
        //
        $isDeleted = $subject->delete();
        return response(['status' => $isDeleted, 'message' => $isDeleted ? "تمت العملية بنجاح" : "فشلت العملية"], $isDeleted ? 200 : 400);
    }
}
