<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Category;
use App\Blog;


class BlogController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::select('id', 'categoryName')->get(['id', 'categoryName']);
        $blogs = Blog::orderBy('id', 'desc')->with(['cat','user'])->limit(6)->get(['id','title','post_excerpt','slug','user_id']);
        return view('home')->with(['blogs' => $blogs,'categories' => $categories]);
    }

    public function allBlogs (Request $request)
    {
        $blogs = Blog::orderBy('id', 'desc')->with(['cat','user'])->select('id','title','post_excerpt','slug','user_id')->paginate(1);
        return view('blogs')->with(['blogs' => $blogs]);
    }


    public function blogSingle(Request $request, $slug)
    {
        $blog = Blog::where('slug', $slug)->with(['cat','tag', 'user'])->first(['id','title','user_id','post']);
        $category_ids = [];
        foreach($blog->cat as $cat) {
            array_push($category_ids, $cat->id);
        }
        $relatedBlogs =  Blog::with('user')->where('id','!=',$blog->id)->whereHas('cat', function($q)use($category_ids){
            $q->whereIn('category_id', $category_ids);
        })->limit(5)->orderBy('id', 'desc')->get(['id','title','slug','user_id']);
        return view('blogsingle')->with(['blog' => $blog, 'relatedBlogs' => $relatedBlogs]);
    }

    public function compose(View $view)
    {
        $cat = Category::select('id', 'categoryName')->get(['id', 'categoryName']);
        $view->with('cat', $cat);
    }


    public function categoryIndex(Request $request, $categoryName, $id)
    {
        $blogs =  Blog::with('user')->whereHas('cat', function($q)use($id){
            $q->where('category_id', $id);
        })->orderBy('id', 'desc')->select('id','title','slug','user_id')->paginate(10);
        return view('category')->with(['blogs' => $blogs,'categoryName' => $categoryName]);
    }

    public function tagIndex(Request $request, $tagName, $id)
    {
        $blogs =  Blog::with('user')->whereHas('tag', function($q)use($id){
            $q->where('tag_id', $id);
        })->orderBy('id', 'desc')->select('id','title','slug','user_id')->paginate(10);
        return view('tag')->with(['blogs' => $blogs,'tagName' => $tagName]);
    }

    public function search (Request $request)
    {
        $str = $request->str;
        $blogs = Blog::orderBy('id', 'desc')->with(['cat','user'])->select('id','title','post_excerpt','slug','user_id');
        $blogs->when($str!='',function($q)use($str){
            $q->orWhereHas('cat',function($q)use($str){
                $q->where('categoryName',$str);
            })
            ->orWhereHas('tag',function($q)use($str){
                $q->where('tagName',$str);
            });
        });
        $blogs = $blogs->paginate(1);
        $blogs = $blogs->appends($request->all());
        return view('blogs')->with(['blogs' => $blogs]);
    }

}
