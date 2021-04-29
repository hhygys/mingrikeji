<?php


class NewsController extends BaseController
{
    /**
     * 控制器过滤器
     */
    public function __construct()
    {
        $this->beforeFilter('auth', array('except' => array('Login', 'DoLogin')));
        $this->beforeFilter('csrf', array('on' => 'post'));
    }

    public function getIndex()
    {
        //$news = News::paginate(5);
        //return View::make('admin.news.list')->with('news',$news);
//        $search = Input::get('search');
//        if ($search == ""){
//            $count = News::count();
//            //$newss = News::orderBy('id', 'desc')->paginate(5);
//            $news = News::paginate(5);
//            return View::make('admin.news.list')->with('news', $news)->with('count', $count);
//        } else{
//            $news = News::Where('title','like','%'.$search.'%')->paginate(5);
//            //$news = News::Where('title','like','%'.$search.'%')->orderBy('id', 'desc')->paginate(5);
//            $count = News::Where('title','like','%'.$search.'%')->count();
//            return View::make('admin.news.list')->with('news', $news)->with('search', $search)->with('count', $count);
//        }


        $datas = Input::all();
        Input::has('options') ? $options = $datas['options'] : $options = 2;
        Input::has('search') ? $search = $datas['search'] : $search = '';

        if ($options == 2) {
            $news = News::Where('title', 'like', '%' . $search . '%')->orderBy('id', 'desc')->paginate(5);
            $count = News::Where('title', 'like', '%' . $search . '%')->count();
            return View::make('admin.news.list', array('news' => $news, 'search' => $search, 'count' => $count, 'options' => $options));
        }
        $news = News::Where('type', 'like', $options)->Where('title', 'like', '%' . $search . '%')->orderBy('id', 'desc')->paginate(5);
        $count = News::Where('type', 'like', $options)->Where('title', 'like', '%' . $search . '%')->count();
        return View::make('admin.news.list', array('news' => $news, 'search' => $search, 'count' => $count, 'options' => $options));
    }

    /**
     * 添加新闻
     */
    public function getAddNews()
    {
        return View::make('admin.news.add');
    }

    public function postAddNews()
    {
        $datas = Input::all();
        $rules = array(
            'title' => 'required|unique:news',
            'publisher' => 'required',
            'content' => 'required'
        );
        $validator = Validator::make($datas, $rules);
        if ($validator->fails()) {
            $msg1 = $validator->messages()->first('title');
            $msg2 = $validator->messages()->first('publisher');
            $msg3 = $validator->messages()->first('content');
            $msg = $msg1 . "\n" . $msg2 . "\n" . $msg3;
            return json_encode(array('success' => false, 'msg' => $msg));
        }

        $news = new News();
        $news->title = $datas['title'];
        $news->publisher = $datas['publisher'];
        $news->content = $datas['content'];
        $news->type = $datas['type'];
        $news->save();

        $data = array('success' => true, 'msg' => '添加成功');
        return json_encode($data);
    }

    /*编辑新闻*/
    public function getEditNews($id)
    {
        $news = News::find($id);
        return View::make('admin.news.edit')->with('news', $news);
    }

    public function postEditNews()
    {
        $datas = Input::all();
        $rules = array(
            'title' => 'required|unique:news',
            'content' => 'required',
        );
        $validator = Validator::make($datas, $rules);
        if ($validator->fails()) {
            $msg1 = $validator->messages()->first('title');
            $msg2 = $validator->messages()->first('content');
            $msg = $msg1 . "\n" . $msg2;
            return json_encode(array('success' => false, 'msg' => $msg));
        }

        $id = $datas['id'];
//        $title = $datas['title'];
//        $publisher = $datas['publisher'];
//        $content = $datas['content'];
//        $type = $datas['type'];
        $news = News::find($id);
        $news->publisher = $datas['publisher'];
        $news->title = $datas['title'];
        $news->content = $datas['content'];
        $news->type = $datas['type'];
        $news->save();

        $data = array('success' => true, 'msg' => '修改成功');
        return json_encode($data);
    }

    /**
     * 删除新闻
     */
    public function postDeloneNews()
    {
        $datas = Input::all();
        $id = $datas['id'];
        $news = News::find($id);
        News::destroy($id);

        return json_encode(array('success' => true, 'msg' => "删除成功"));
    }

    /**
     * 删除所选新闻
     */

    public function postDelallNews()
    {
        $datas = Input::all();

        foreach ($datas['id'] as $v) {
            $id = $v;
            News::destroy($id);
        }

        return json_encode(array('success' => true, 'msg' => "删除成功"));
    }

}