<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


use App\Photo;
use App\Page;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $photos = Photo::all();
        return view('admin.photos.index', compact('photos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.photos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::id();
        $validator = Validator::make($data, [
            'name' => 'required|max:200',
            'description' => 'required',
            'path' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.photos.create')
            ->withErrors($validator)
            ->withInput();
        }

        if (isset($data['path'])) {
            $path = Storage::disk('public')->put('images', $data['path']);
            $photo = new Photo;
            $photo->user_id = Auth::id();
            $photo->name = $data['name'];
            $photo->path = $path;
            $photo->description = $data['description'];
            $saved = $photo->save();
        }

        if(!$saved) {
            abort('404');
        }

        return redirect()->route('admin.photos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $photo = Photo::findOrFail($id);
        return view('admin.photos.show', compact('photo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = Page::findOrFail($id);
        $userId = Auth::id();
        $author = $page->user_id;

        if ($userId != $author) {
            abort('404');
        }
        $photos = Photo::all();

        return view('admin.pages.edit', compact('photos'));
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
        $userId = Auth::id();
        $author = $page->user_id;

        if ($userId != $author) {
            abort('404');
        }

        $validator = Validator::make($data, [
            'name' => 'required|max:200',
            'description' => 'required',
            'path' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.photos.create')
            ->withErrors($validator)
            ->withInput();
        }

        if (isset($data['update-path'])) {
            foreach($page->photos as $photo) {
                $deleted = Storage::disk('public')->delete($photo->path);
                $page->photos()->detach($photo->id);
                $photoDatabase = Photo::find($photo->id);
                $photoDatabase->delete();
            }

            $path = Storage::disk('public')->put('images', $data['photo-file']);
            $photo = new Photo;
            $photo->user_id = Auth::id();
            $photo->name = $data['title'];
            $photo->path = $path;
            $photo->description = $data['description'];
            $saved = $photo->save();
        }


        if(!$saved) {
            abort('404');
        }

        return redirect()->route('admin.photos.index')->with('status', 'Foto aggiornata correttamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
