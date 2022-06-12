<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClassRoomController extends Controller
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
            $classRooms = ClassRoom::withCount('schoolSections')->get();
        } else {
            $classRooms = ClassRoom::withCount(['schoolSections' => function ($query) {
                $query->where('school_id', auth('school')->user()->id);
            }])->get();
        }
        return response()->view('cms.class-rooms.index', ['classRooms' => $classRooms]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return response()->view('cms.class-rooms.create');
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
            'level' => 'required|integer|min:1|max:12',
            'stage' => 'required|in:Primary,Preparatory,Secondary',
        ]);
        if (!$validator->fails()) {
            $classRoom = new ClassRoom();
            $classRoom->name = $request->get('name');
            $classRoom->level = $request->get('level');
            $classRoom->stage = $request->get('stage');
            $isSaved = $classRoom->save();
            return response(['status' => $isSaved, 'message' => $isSaved ? "تمت العملية بنجاح" : "فشلت العملية"], $isSaved ? 200 : 400);
        } else {
            return response(['status' => false, 'message' => $validator->getMessageBag()->first()], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ClassRoom  $classRoom
     * @return \Illuminate\Http\Response
     */
    public function show(ClassRoom $classRoom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ClassRoom  $classRoom
     * @return \Illuminate\Http\Response
     */
    public function edit(ClassRoom $classRoom)
    {
        //
        return response()->view('cms.class-rooms.edit', ['classRoom' => $classRoom]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ClassRoom  $classRoom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClassRoom $classRoom)
    {
        //
        $validator = Validator($request->all(), [
            'name' => 'required|string|max:35',
            'level' => 'required|integer|min:1|max:12',
            'stage' => 'required|in:Primary,Preparatory,Secondary',
        ]);
        if (!$validator->fails()) {
            $classRoom->name = $request->get('name');
            $classRoom->level = $request->get('level');
            $classRoom->stage = $request->get('stage');
            $isSaved = $classRoom->save();
            return response(['status' => $isSaved, 'message' => $isSaved ? "تمت العملية بنجاح" : "فشلت العملية"], $isSaved ? 200 : 400);
        } else {
            return response(['status' => false, 'message' => $validator->getMessageBag()->first()], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ClassRoom  $classRoom
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClassRoom $classRoom)
    {
        //
        $isDeleted = $classRoom->delete();
        return response(['status' => $isDeleted, 'message' => $isDeleted ? "تمت العملية بنجاح" : "فشلت العملية"], $isDeleted ? 200 : 400);
    }
}
