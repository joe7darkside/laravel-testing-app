<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\Photo;
use Illuminate\Http\Request;

class CrudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $photos = Photo::all();
        return $photos;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $photo =  $request->validate([
            'name' => 'required',
            'price' => 'required',
            'type' => 'required'
        ]);
        $photo = new Photo;

        $photo->name = $request->name;
        $photo->price = $request->price;
        $photo->type = $request->type;
        $photo->save();

        if (!$photo) {
            return 'something went wrong';
        }
        return $photo;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $photo = Photo::find($id);
        return $photo;
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
        $photo =  $request->validate([
            'name' => 'required',
            'price' => 'required',
            'type' => 'required'
        ]);
        $photo = Photo::find($id);
        $photo->name = $request->name;
        $photo->price = $request->price;
        $photo->type = $request->type;
        $photo->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $photo=Photo::find($id);

        $photo->delete();
    }
}
