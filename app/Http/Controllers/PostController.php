<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Pagination\Paginator;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    //    $posts= Post::paginate(5);
    //  return $posts = DB::table('posts')->where('user_id',auth()->user()->id)->exists();
    //  return $posts->title;
        //   return  $posts = DB::table('users')
        //     ->join('posts', 'users.id', '=', 'posts.user_id')->where('user_id', 1)
        //     ->select('users.*', 'posts.title')
        //     ->get();
        //   return  $posts = DB::table('posts')
        //     ->crossJoin('users', 'posts.user_id', '=', 'users.id')
        //     ->get();
        // return $posts = DB::table('posts')->where('user_id',auth()->user()->id)->select('user_id','title')->get();
        // return $posts = DB::table('posts')->where('user_id',auth()->user()->id)->pluck('title');
    //    return $user = DB::table('users')->where('id',$posts->user_id )->get();
    // $posts = auth()->user()->posts()->paginate(5);
    $posts = Post::with('user')->get();
    // $posts = Post::all();
    // return $posts;
        // dd ($posts);
      return  view('admin.posts.index',compact('posts') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create',Post::class);

        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $this->authorize('create',Post::class);

       $input= $request->validate([
            'title'=> 'required',
            // 'post_img'=>'mimes:jpeg,png',
            'post_img'=>'file',
            'body'=>'required'
        ]);

        if (request('post_img')) {
            $input['post_img']= request('post_img')->store('images');
        }
        auth()->user()->posts()->create($input);
        // Session::flash('post_create_massage','post was created');
        session()->flash('post_create_massage','post was created');

        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('blog_post',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        // $post= Post::findOrFail($post);
        $this->authorize('view',$post);

        return view('admin.posts.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $input= $request->validate([
            'title'=> 'required',
            // 'post_img'=>'mimes:jpeg,png',
            'post_img'=>'file',
            'body'=>'required'
        ]);
        // return $input;
        if (request('post_img')) {
            $input['post_img']= request('post_img')->store('images');
        }else{
            $img= Post::find($post);
            $input['post_img'] = $post->post_img;
        }
        // return $input;
        // return Post::find($post);
        // $this->authorize('update',$post);
        $post->update($input);
        session()->flash('post_updated_massage','post was updated');

        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
       $post-> delete();
       Session::flash('massage','post was deleted');
        return back();
    }
}
