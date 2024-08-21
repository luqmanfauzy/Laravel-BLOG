<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

//Resource Controller
class DashboardPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = [
            "posts" => Post::where('users_id', Auth::user()->id)->get(),
            "nameAuthor" => Auth::user()->name
        ];

        return view("dashboard.dashboard", compact("datas"));
    }

    /**
     * Show the form for creating a new resource.
     */ 
    public function create()
    {
        $categories = Category::all();
        return view('dashboard.createPost', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        // ddd($request);
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:posts,slug',
            'categories_id' => 'required|integer|between:1,5',
            'image' => 'image|file|max:5000',
            'body' => 'required|string',
        ]);

        if($request->file('image')){
            $validatedData['image'] = $request->file('image')->store('post-image');
        }

        $validatedData['users_id'] = Auth::user()->id;
        $validatedData['excerpt'] = Str::limit($request->body, 100);

        Post::create($validatedData);
        return redirect()->route('dashboard.index')->with('success', 'post created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($detail)
    {
        $detail = Post::where('slug', $detail)->first();
        // dd($detail);
        return view('dashboard.detailDashboard', compact('detail'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {   
        $post = Post::where('slug', $slug)->first();
        $categories = Category::all();
        return view('dashboard.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $slug)
    {
        $rules = [
            'title' => 'required|string|max:255',
            'categories_id' => 'required|integer|between:1,5',
            'image' => 'image|file|max:5000',
            'body' => 'required|string',
        ];

        //cek jika slug beda dari sebelumnya, maka harus di validasi
        if($request->slug != $slug) {
            $rules['slug'] = 'required|unique:posts';
        }
        
        $validatedData = $request->validate($rules);

        if($request->file('image')){
            if($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData['image'] = $request->file('image')->store('post-image');
        }

        $validatedData['users_id'] = Auth::user()->id;
        $validatedData['excerpt'] = Str::limit($request->body, 100);

        Post::where('slug', $slug)
             ->update($validatedData);

        return redirect()->route('dashboard.index')->with('success update', 'post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        if($post->image) {
            Storage::delete($post->image);
        }

        //menghapus berdasarkan slug bukan id
        $post = Post::where('slug', $slug)->first();
        $post->delete();

        return redirect()->route('dashboard.index')->with('success', 'Post deleted successfully');
    }



}
