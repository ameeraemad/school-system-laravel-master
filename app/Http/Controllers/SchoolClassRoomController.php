<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use App\Models\SchoolClassRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class SchoolClassRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $schoolClassRooms = SchoolClassRoom::withCount('students')->with('classRoom')->where('school_id', auth('school')->user()->id)->get();
        return response()->view('cms.school-class-rooms.index', ['schoolClassRooms' => $schoolClassRooms]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $classRooms = ClassRoom::all();
        return response()->view('cms.school-class-rooms.create', ['classRooms' => $classRooms]);
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
            'section' => 'required|numeric',
            'class_room' => 'required|exists:class_rooms,id'
        ]);
        if (!$validator->fails()) {
            $schoolClassRoom = new SchoolClassRoom();
            $schoolClassRoom->class_room_id = $request->get('class_room');
            $schoolClassRoom->section = $request->get('section');
            $schoolClassRoom->school_id = $request->user('school')->id;
            $isSaved = $schoolClassRoom->save();
            return response()->json([
                'message' => $isSaved ? 'Saved successfully' : 'Failed to save'
            ], $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SchoolClassRoom  $schoolClassRoom
     * @return \Illuminate\Http\Response
     */
    public function show(SchoolClassRoom $schoolClassRoom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SchoolClassRoom  $schoolClassRoom
     * @return \Illuminate\Http\Response
     */
    public function edit(SchoolClassRoom $schoolClassRoom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SchoolClassRoom  $schoolClassRoom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SchoolClassRoom $schoolClassRoom)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SchoolClassRoom  $schoolClassRoom
     * @return \Illuminate\Http\Response
     */
    public function destroy(SchoolClassRoom $schoolClassRoom)
    {
        //
    }
}
