<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('show');
        $this->middleware('role:driver|mechanics|superadmin|storekeeper|manager|muhasibu')->except('show');
    }

    public function index()
    {
        $posts = Post::orderBy('updated_at', 'desc')->paginate(10);
        return view('news.news')->with('posts', $posts);
    }

    public function create()
    {
        return view('news.create');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|max:255',
            'description' => 'required',
            'image' => 'required|image|max:5024',
        ]);

        $slug = Str::slug($request->title);



        if ($request->hasFile('image')) {
            $file = $request->file('image');

            $path = Storage::putFileAs(
                'public/posts/' . $slug,
                $file,
                time() . '.' . $file->getClientOriginalExtension(),
            );
        }

        $post = Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'slug' => $slug,
            'image' => $path,
        ]);

        if ($post) {
            Session::flash('message', 'Post created successful ');
            return redirect()->route('posts');
        } else {
            Session::flash('message', 'Post  unsuccessful created');
            return redirect()->route('posts');
        }
    }


    public function show($slug)
    {
        $post = Post::where('slug', $slug)->first();
        if (is_null($post)) {
            abort(404, 'Post Not Found');
        } else {
            $previous = Post::where('id', '<', $post->id)->max('id');
            $nextN = Post::where('id', '>', $post->id)->min('id');

            if ($previous == null) {
                $prev = Post::orderBy('create_at', 'asc')->last();
            } else {
                $prev = Post::where('id', $previous)->first();
            }

            if ($nextN == null) {
                $next = Post::orderBy('created_at', 'asc')->first();
            } else {
                $next = Post::where('id', $nextN)->first();
            }

            return view('news.show')->with('post', $post)->with('prev', $prev)->with('next', $next);
        }
    }


    public function edit($slug)
    {
        $post = Post::where('slug', $slug)->first();

        return view('news.update')->with('post', $post);
    }


    public function update($slug, Request $request)
    {
        $post = Post::where('slug', $slug)->first();

        $this->validate($request, [
            'title' => 'required|string|max:255',
            'description' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $this->validate($request, [
                'image' => 'required|image|max:5024',
            ]);

            $file = $request->file('image');

            $path = Storage::putFileAs(
                'public/posts/' . $post->slug,
                $file,
                time() . '.' . $file->getClientOriginalExtension(),
            );

            $post->image = $path;
        }

        $post->title = $request->title;
        $post->description = $request->description;

        if ($post->save()) {
            Session::flash('message', 'Post updated successful ');
            return redirect()->route('posts');
        } else {
            Session::flash('message', 'Post  unsuccessful updated');
            return redirect()->route('posts');
        }
    }

    public function destroy($slug)
    {
        $post = Post::where('slug', $slug)->first();

        if (is_null($post)) {
            Session::flash('message', 'Failed to delete post');
            return redirect()->route('posts');
        } else {
            Session::flash('message', 'Post was successful deleted');
            return redirect()->route('posts');
        }
    }
}
