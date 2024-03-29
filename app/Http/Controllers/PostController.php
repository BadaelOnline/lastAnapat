<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\{Category, Post, Tag};

use Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = Post::orderBy('id','desc')->get();

        return view('admin.post.index',compact('post'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get();
        $tags = Tag::get();
        return view('admin.post.create',compact('categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        \Validator::make($request->all(), [
            "title" => "required",
//            "cover" => "required|max:2048",
            "body" => "required",
            "category" => "required",
            "tags" => "array|required",
            "keyword" => "required",
            "meta_desc" => "required"
        ])->validate();
        $data = $request->all();
        $data['slug'] = \Str::slug(request('title'));
        $data['category_id'] = request('category');
        $data['status'] = 'PUBLISH';
        $data['author_id'] = Auth::user()->id;
        $cover = $request->file('cover');
        if($cover){
        $cover_path = $cover->store('images/blog', 'public');
        $data['cover'] = $cover_path;
        }
        $post = Post::create($data);
        $post->tags()->attach(request('tags'));
        if ($post) {
            if($request->public == null){
                $post->public = 0;
            }else{
                $post->public = 1;
            }
            $post->save();
                return redirect()->route('admin.post')->with('success', 'Post added successfully');
               } else {
                return redirect()->route('admin.post.create')->with('error', 'Post failed to add');
               }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::get();
        $tags = Tag::get();
        return view('admin.post.edit',compact('post','categories','tags'));
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
        \Validator::make($request->all(), [
            "title" => "required",
            "body" => "required",
            "category" => "required",
            "tags" => "array|required",
            "keyword" => "required",
            "meta_desc" => "required",
//            "cover" => "max:2048"
        ])->validate();
        $post = Post::findOrFail($id);
        $data = $request->all();
        $data['slug'] = \Str::slug(request('title'));
        $data['category_id'] = request('category');
        $cover = $request->file('cover');
        if($cover){
            if($post->cover && file_exists(storage_path('app/public/' . $post->cover))){
                \Storage::delete('public/'. $post->cover);
            }
        $cover_path = $cover->store('images/blog', 'public');
        $data['cover'] = $cover_path;
        }
        $update = $post->update($data);
        $post->tags()->sync(request('tags'));
        if ($update) {
            if($request->public == "0"){
                $post->public = 0;
            }else{
                $post->public = 1;
            }
            $post->save();
                return redirect()->route('admin.post')->with('success', 'Data added successfully');
               } else {
                return redirect()->route('admin.post.create')->with('error', 'Data failed to add');
               }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect()->route('admin.post')->with('success','Post moved to trash');
    }

    public function trash(){
        $post = Post::onlyTrashed()->get();

        return view('admin.post.trash', compact('post'));
    }

    public function restore($id) {
        $post = Post::withTrashed()->findOrFail($id);

        if ($post->trashed()) {
            $post->restore();
            return redirect()->route('admin.post.trash')->with('success','Data successfully restored');
        }else {
            return redirect()->route('admin.post.trash')->with('error','Data is not in trash');
        }
    }

    public function deletePermanent($id){

        $post = Post::withTrashed()->findOrFail($id);

        if (!$post->trashed()) {

            return redirect()->route('admin.post.trash')->with('error','Data is not in trash');

        }else {

            $post->tags()->detach();


            if($post->cover && file_exists(storage_path('app/public/' . $post->cover))){
                \Storage::delete('public/'. $post->cover);
            }

        $post->forceDelete();

        return redirect()->route('admin.post.trash')->with('success', 'Data deleted successfully');
        }
    }
}
