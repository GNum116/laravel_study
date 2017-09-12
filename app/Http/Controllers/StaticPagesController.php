<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class StaticPagesController extends Controller
{
    public function home()
	{
		#return '主页';
        if (Auth::check()) {
            $feedItems = Auth::user()->feed()->paginate(10);
        }

		return view('static_pages/home', compact('feedItems'));
	}

	public function help()
	{
		#return '帮助页';
		return view('static_pages/help');
	}

	public function about()
	{
		#return '关于页';
		return view('static_pages/about');
	}
}
