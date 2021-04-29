<?php


class FrontController extends BaseController
{

    public function Index(){
        return View::make('index');
    }

    public function getAbout(){
        return View::make('front.about');
    }
    public function getContact(){
        return View::make('front.contact');
    }
    public function getContent(){
        return View::make('front.content');
    }
    public function getNewsdetail($id){
        $news = News::find($id);
        return View::make('front.newsdetail')->with('news',$news);
    }
    public function getNewslist(){
        $news = News::paginate(5);
        return View::make('front.newslist')->with('news',$news);
    }
    public function getIndex(){
        $news = News::paginate(5);
        return View::make('admin.news.list')->with('news',$news);
    }
}