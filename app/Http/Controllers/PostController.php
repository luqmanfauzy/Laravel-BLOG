<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use Illuminate\Contracts\View\View;

use function Laravel\Prompts\search;

class PostController extends Controller
{
    public function index()
    {
        $search = request('search');

        $posts = Post::with(['user', 'category'])
        ->when($search, function ($query, $search) {
            return $query->where('title', 'like', '%' . $search . '%')
                        ->orWhere('body', 'like', '%' . $search . '%')
                        ->orWhere('excerpt', 'like', '%' . $search . '%')
                        ->orWhereHas('user', function ($query) use ($search) {
                            $query->where('name', 'like', '%' . $search . '%');
                        })
                        ->orWhereHas('category', function ($query) use ($search) {
                            $query->where('name_category', 'like', '%' . $search . '%');
                        });
        })
        ->simplePaginate(5);

        // Append search parameter to pagination links
        $posts->appends(['search' => $search]);

        $categories = Category::all();
        return view("home", compact("posts", "categories"));
    }


    public function postCategories($id)
    {
        $nameCategory = Category::find($id);
        $postCategories = Post::where('categories_id', $id)->paginate(5);
        $authorCategories = User::findOrFail($id);
        return view("category", compact("postCategories", "nameCategory", "authorCategories"));
    }

    public function indexBySlug($slug) 
    {
        $posts = Post::where("slug", $slug)->first();
        return view("detail", compact("posts"));
    }

    public function indexById($id)
    {
        $authorPost = Post::where('users_id', $id)->paginate(5);
        $nameAuthor = Post::where('users_id', $id)->first();
        return view("author", compact("authorPost", "nameAuthor"));
    }

    public function indexService()
    {
        $posts = Post::all();
        $active = 'service';
        return view("service", compact("posts", "active"));
    }

}
