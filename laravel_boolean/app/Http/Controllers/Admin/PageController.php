<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


use App\Page;
use App\Category;
use App\Tag;
use App\Photo;
use App\User;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::orderBy('created_at', 'DESC')->paginate(10);

        return view('admin.pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        $photos = Photo::all();

        return view('admin.pages.create', compact('categories', 'tags', 'photos'));
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

        if(!isset($data['visible'])) {
            $data['visible'] = 0;
        } else {
            $data['visible'] = 1;
        }

        $data['user_id'] = Auth::id();
        $validator = Validator::make($data, [
            'title' => 'required|max:200',
            'body' => 'required',
            'summary' => 'required',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'required|array',
            'tags.*' => 'exists:tags,id',
            'photos' => 'required|array',
            'photos.*' => 'exists:photos,id'
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.pages.create')
            ->withErrors($validator)
                ->withInput();
        }

        $page = new Page;
        $page->fill($data);
        $saved = $page->save();

        if(!$saved) {
            abort('404');
        }

        if(isset($data['tags'])) {
            $page->tags()->attach($data['tags']);
        }

        if(isset($data['photos'])) {
            $page->photos()->attach($data['photos']);
        }

        return redirect()->route('admin.pages.show', $page->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $page = Page::findOrFail($id);
        return view('admin.pages.show', compact('page'));
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
        $authors = $page->user_id;
        if ($userId != $authors) {
            abort('404');
        }
        $categories = Category::all();
        $tags = Tag::all();
        $photos = Photo::all();

        return view('admin.pages.edit', compact('page','categories', 'tags', 'photos'));
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
        $data = $request->all();
        $page = Page::findOrFail($id);
        $userId = Auth::id();
        $author = $page->user_id;
        if ($userId != $author) {
            abort('404');
        }

        if(!isset($data['visible'])) {
            $data['visible'] = 0;
        } else {
            $data['visible'] = 1;
        }

        $data['user_id'] = Auth::id();
        $validator = Validator::make($data, [
            'title' => 'required|max:200',
            'body' => 'required',
            'summary' => 'required',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'required|array',
            'tags.*' => 'exists:tags,id',
            'photos' => 'required|array',
            'photos.*' => 'exists:photos,id'
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.pages.update')
            ->withErrors($validator)
                ->withInput();
        }

        $page->fill($data);
        $saved = $page->update();

        if(!$saved) {
            abort('404');
        }

        $page->tags()->sync($data['tags']);

        $page->photos()->sync($data['photos']);

        return redirect()->route('admin.pages.show', $page->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $page = Page::findOrFail($id);
        $userId = Auth::id();
        $author = $page->user_id;
        if ($userId != $author) {
            abort('404');
        }

        $page->tags()->detach();
        $page->photos()->detach();

        $page->delete();

        return redirect()->back()->with('status', 'Post cancellato');
    }
}
