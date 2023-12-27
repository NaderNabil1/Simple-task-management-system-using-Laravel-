<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;

class PageController extends Controller
{
    public function home(){
        $page = Page::find(1);
        return view('FrontEnd.Page.index', compact('page'));
    }

    public function about(){
        $page = Page::find(2);
        return view('FrontEnd.Page.about', compact('page'));
    }

    public function contact(){
        $page = Page::find(3);
        return view('FrontEnd.Page.contact',compact('page'));
    }
}
