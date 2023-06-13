<?php
namespace App\Http\Controllers\Admin\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\PostCat;

class PostCatController extends Controller
{
    
    public function index()
    {
        //$categories = PostCat::all();
		$categories=PostCat::paginate(50);	
		$categories_count = count($categories);
        return view('admin.category.index', compact('categories','categories_count'));
    }

    
    public function create()
    {
        $categories = PostCat::all();
        return view('admin.category.create', compact($categories));
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
            'name' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);
        $category = new PostCat;
        $category->name = $request->name;
        $category->image = $image;
        $category->save();
     
        return redirect()->route('admin.category.index')
        ->with('success','Category has been created successfully.');
    }

   
    public function show(Post $post)
    {
        return view('admin.category.show', compact('post'));
    }

    
    public function edit($id)
    {
        $postcat = PostCat::findOrFail($id);
        return view('admin.category.edit',compact('postcat'));
    }

    
    public function update(Request $request, $id)
    {


       $image = '';
        $year = date("Y/m"); 
        if($request->file('image'))
        {
            $image = $request->file('image')->store($year,['disk'=> 'uploads']);
            $image = url('wp-content/uploads/'.$image);
        }

          $request->validate([
            'name' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);
		$category = PostCat::find($id);
        $category->name = $request->name;
        $category->image = $image;
        $category->save();
        
        //PostCat::whereId($id)->update($data);

        return redirect('admin/category')->with(['status' => 'success' , 'msg' => 'Successfully added']);
    }

    
    public function destroy($id)
    {
        $post=PostCat::findOrFail($id);
        $post->delete();
        return redirect()->route('admin.category.index')
        ->with('success','Category deleted successfully');
    }

    public function post_status(Request $request, $post_status, $id){
        $category = PostCat::findOrFail($id);
        $category->post_status = $post_status;
        $category->save();
        return redirect('admin/category')->with(['status ' => 'success', 'msg' => 'Added Successfully!!']);
    }
}
