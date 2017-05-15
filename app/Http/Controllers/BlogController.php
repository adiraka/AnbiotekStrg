<?php

namespace Anbiotek\Http\Controllers;

use Session;
use Datatables;
use Illuminate\Http\Request;

use Anbiotek\Blog;

class BlogController extends Controller
{
	public function getAdminBlog()
	{
		return view('blog.add');
	}

	public function postAdminBlog(Request $request)
	{
		$this->validate($request, [
			'user_id' => 'required',
			'judul' => 'required|unique:blog',
			'teks' => 'required',
		]);

		$slug = str_slug(str_limit($request->judul, 100), '-');

		$blog = new Blog;
		$blog->user_id = $request->user_id;
		$blog->judul = $request->judul;
		$blog->slug = $slug;
		$blog->teks = $request->teks;
		$blog->save();
		
		Session::flash('success', 'Blog berhasil ditambahkan!');

		return redirect()->back();
	}

	public function viewAdminBlog(Request $request)
	{
		if ($request->ajax()) {
			# code...
		}

		return view('blog.view');
	}

    public function getBlogHome()
    {
    	$blog = Blog::simplePaginate(10);
    	
    	return view('front.blog.home')->with([
    		'blog' => $blog,
    	]);
    }

    public function getBlogDetail($id) {
    	$blogDetail = Blog::find($id);

    	return view('front.blog.detail')->with([
    		'blogDetail' => $blogDetail,
    	]);
    }
}
