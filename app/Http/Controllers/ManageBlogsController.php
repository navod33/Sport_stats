<?php

namespace App\Http\Controllers;

use App\Entities\Blogs\Blog;
use App\Entities\Blogs\BlogsRepository;
use App\Entities\Files\File;
use App\Entities\Files\FilesRepository;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ManageBlogsController extends Controller
{

    public function __construct(BlogsRepository $repo, Blog $model,FilesRepository $filerepo)
    {
        $this->repo = $repo;
        $this->model = $model;
        $this->filerepo = $filerepo;
    }

    public function index(Request $request)
    { 

        $articles = Blog::query();
        if($request->q){
            $articles = $articles->where('title', 'like', '%' . $request->q . '%');
        } 
       // $entity = $articles;
       // $filerepo = $this->filerepo;
       
        return view('manage.blogs.index',['pageTitle'=>'blog','allItems'=>$articles->paginate()]);
    
    }


    public function create()
    {
        return view('manage.blogs.create');
    }


    public function show($id)
    {

        // return view('blogs.view', [
        //     'blog' => Blog::findOrFail($id)
        // ]);
        $post = Blog::find($id);
        
        
        $pageTitle = 'Blog';
        $entity = $post;
        return view('manage.blogs.view', compact('pageTitle','entity'));
    }


    public function store(Request $request)
    {
        
        $request->validate([
            'title' =>'required|string',
            'content' =>'required|string',
            'profile_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|required',
        ]);

        $post = new Blog();
        $post->title = $request->title;
        $post->description = $request->content;
        $post->save();

        $post_id=$post->id;

        if ($files = $request->file('profile_image')) 
        {
            
              $path = $request->file('profile_image')->store('public/blog');
            if ($path) {
                $key = 'file_key_' . ((string) Str::uuid());
                $file = new File([
                    'name' => 'blog_image',
                    'key' => $key,
                    'allow_public_access' => true,
                    'original_filename' => $files->getClientOriginalName(),
                    'file_path' => $path,
                    'file_disk' => 'local',
                    'file_url'  => 'storage/'.$path,
                    'file_size_bytes' => 0,
                    'uploaded_by_user_id' => $request->user()->id,
                    'blog_id' => $post_id,
                ]);
                $file->category = 'Blog';
                $file->save();
            } 
        }

	    return redirect()->back()->with('success', 'Successfully Saved');
    }

    public function destroy($id)
    {
        try {
            $post =  Blog::find($id);
            $post->delete();
            return redirect()->back()->with('success', 'Record deleted.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong. Try again.');
        }
    }


    public function edit($id)
    {
        $post = Blog::find($id);
        
        $pageTitle = 'Blog';
        $entity = $post;
        return view('manage.blogs.edit', compact('pageTitle','entity'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'title' =>'required|string',
            'content' =>'required|string',
            'profile_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $post = Blog::find($id);
        $post->title = $request->title;
        $post->description = $request->content;
        $post->update();

        $post_id=$id;

        if ($files = $request->file('profile_image')) 
        {
            $userfiles = File::where('blog_id', $post_id)->first();
                if($userfiles)
                {
                    // delete image from storage
                    Storage::delete($userfiles->file_path);
                    // delete record from database to keep one record
                    File::where('blog_id', $post_id)
                    ->delete();
                }

              $path = $request->file('profile_image')->store('public/blog');
            if ($path) {
                $key = 'file_key_' . ((string) Str::uuid());
                $file = new File([
                    'name' => 'blog_image',
                    'key' => $key,
                    'allow_public_access' => true,
                    'original_filename' => $files->getClientOriginalName(),
                    'file_path' => $path,
                    'file_disk' => 'local',
                    'file_url'  => 'storage/'.$path,
                    'file_size_bytes' => 0,
                    'uploaded_by_user_id' => $request->user()->id,
                    'blog_id' => $post_id,
                ]);
                $file->category = 'Blog';
                $file->save();
            } 
        }

	    return redirect()->back()->with('success', 'Successfully Saved');
    }
}
