<?php

namespace App\Http\Controllers\v2\Admin\Auth;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\PostCat;

class PostController extends Controller
{
    
    public function index(Request $request) 
    {
    	$post_category = PostCat::all();
    	
     	if($request->input('search')=='search')
    	{
    		$search_txt = $request->postcategory;
    		$posts = Post::select('id','title','post_category','description','image')->orderBy('title','asc')->where('post_category','LIKE','%'.$search_txt.'%')->paginate(50);
			$post_count = count($posts);

    	}
    	else
    	{
       		
			$posts = Post::paginate(50);	
			$post_count = Post::count();
       
    	}
    	 return view('admin.posts.index',compact('posts','post_category','post_count'));
    }

    
    public function create()
    {
        $post_cat = PostCat::all();
        return view('admin.posts.create', compact('post_cat'));
    }

   
    public function store(Request $request)
    {
        $image = '';
        $year = date("Y/m"); 
        if($request->file('image'))
        {
            $image = $request->file('image')->store($year,['disk'=> 'uploads']);
            $image = url('wp-content/uploads/'.$image);
        }
        $request->validate([
            'title' => 'required',
            'post_category' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'description' => 'required',
        ]);
        //dd(implode(',', $request->post_category));die;
        $post = new Post;
        $post->image = $image;
        $post->title = $request->title;
        $post->post_category = implode(',', $request->post_category);
        $post->description = $request->description;
        $post->save();
     
        return redirect()->route('admin.posts.index')
        ->with('success','Post has been created successfully.');

    }

    
    public function show($id)
    {

        $post = Post::findOrFail($id);
        return view('admin.posts.show', compact('post'));
    }

   
    public function edit($id)
    {
        $post_cat = PostCat::all();
        $post = Post::findOrFail($id);
        return view('admin.posts.edit',compact('post','post_cat')); 
    }

   
    public function update(Request $request, $id)
    {
        $image = '';
        $year = date("Y/m"); 
          $request->validate([
            'title' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'description' => 'required'
         ]);

        if($request->file('image'))
        {
            $image = $request->file('image')->store($year,['disk'=> 'uploads']);
            $image = url('wp-content/uploads/'.$image);
        }   
        $post = Post::find($id);
        $post->title = $request->title;
        $post->post_category = implode(',', $request->post_category);
        $post->description = $request->description;
        $post->image = $image;
        $post->save();
        
        //PostCat::whereId($id)->update($data);

        return redirect('admin/posts')->with(['status' => 'success' , 'msg' => 'Successfully added']);
    }

    
    public function destroy(Post $post)
    {
      $post->delete();
       return redirect()->route('admin.posts.index')
        ->with('success','post deleted successfully');
    }
}
