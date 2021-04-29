<?php


class UserController extends BaseController
{
    /**
     * 控制器过滤器
     */
    public function __construct()
    {
        $this->beforeFilter('auth', array('except' => array('Login', 'DoLogin')));
        $this->beforeFilter('csrf', array('on' => 'post'));
    }

    public function adminIndex()
    {
        $users = User::all();
        return View::make('adminindex')->with('users', $users);
    }

    public function getIndex()
    {
//        $search = Input::get('search');
//        if ($search == ""){
//            $count = User::count();
//            $users = User::paginate(5);
//            return View::make('admin.user.list')->with('users', $users)->with('count', $count);
//        } else{
//            $users = User::Where('username','like','%'.$search.'%')->paginate(5);
//            $count = User::Where('username','like','%'.$search.'%')->count();
//            return View::make('admin.user.list')->with('users', $users)->with('search', $search)->with('count', $count);
//        }

        if (!Auth::user()->type) {
            return Redirect::to('/login');
        }

        $datas = Input::all();
        Input::has('options') ? $options = $datas['options'] : $options = 2;
        Input::has('search') ? $search = $datas['search'] : $search = '';

        if ($options == 2) {
            $users = User::Where('username', 'like', '%' . $search . '%')->orderBy('id', 'desc')->paginate(5);
            $count = User::Where('username', 'like', '%' . $search . '%')->count();
            return View::make('admin.user.list', array('users' => $users, 'search' => $search, 'count' => $count, 'options' => $options));
        }
        $users = User::Where('type', 'like', $options)->Where('username', 'like', '%' . $search . '%')->orderBy('id', 'desc')->paginate(5);
        $count = User::Where('type', 'like', $options)->Where('username', 'like', '%' . $search . '%')->count();
        return View::make('admin.user.list', array('users' => $users, 'search' => $search, 'count' => $count, 'options' => $options));
    }


    /*
     * 添加用户*/
    public function getAddUser()
    {

        return View::make('admin.user.add');
    }

    public function postAddUser()
    {
        //表单验证
        //数据
        $datas = Input::all();
        //规则
        $rules = array(
            'username' => 'required|unique:users|min:5|regex:/^[a-zA-Z][a-zA-Z0-9]*/',
            'email' => 'required|unique:users|email',
            'password' => 'required|min:6|confirmed',
        );
        $validator = Validator::make($datas, $rules);
        if ($validator->fails()) {
            $msg1 = $validator->messages()->first('username');
            $msg2 = $validator->messages()->first('email');
            $msg3 = $validator->messages()->first('password');
            $msg = $msg1 . "\n" . $msg2 . "\n" . $msg3;
            return json_encode(array('success' => false, 'msg' => $msg));
        }

        $user = new User();
        $user->username = $datas['username'];
        $user->email = $datas['email'];
        $user->password = Hash::make($datas['password']);
        $user->type = $datas['type'];
        $user->save();

        $data = array('success' => true, 'msg' => '添加成功');
        return json_encode($data);
    }

    public function getEditUser($id)
    {
        $user = User::find($id);
        return View::make('admin.user.edit')->with('user', $user);
    }

    public function postEditUser()
    {
        $datas = Input::all();
        $rules = array(
            'password' => 'required|min:6|confirmed',
        );
        $validator = Validator::make($datas, $rules);
        if ($validator->fails()) {
            $msg = $validator->messages()->first('password');
            return json_encode(array('success' => false, 'msg' => $msg));
        }
        $id = $datas['id'];
        $password = $datas['password'];
        $user = User::find($id);
        $user->password = Hash::make($password);
        $user->save();

        $data = array('success' => true, 'msg' => '修改成功');
        return json_encode($data);
    }

    /**
     * 删除单个用户
     */
    public function postDeloneUser()
    {
        $datas = Input::all();
        $id = $datas['id'];
        User::destroy($id);

        return json_encode(array('success' => true, 'msg' => "删除成功"));
    }

    /**
     * 删除所选用户
     */
    public function postDelallUser()
    {
        $datas = Input::all();

        foreach ($datas['id'] as $v) {
            $id = $v;
            User::destroy($id);
        }

        return json_encode(array('success' => true, 'msg' => "删除成功"));
    }

    public function Login()
    {
        return View::make("admin.login");
    }

    public function DoLogin()
    {
        $datas = Input::all();
        $rules = array(
            'username' => 'required',
            'password' => 'required'
        );
        $validator = Validator::make($datas, $rules);
        if ($validator->fails()) {
            $msg1 = $validator->messages()->first('username');
            $msg2 = $validator->messages()->first('password');
            $msg = $msg1 . "\n" . $msg2 . "\n";
            return json_encode(array('success' => false, 'msg' => $msg));
        }

        $username = $datas['username'];
        $password = $datas['password'];
        $type = User::where('username', 'like', $username)->first();
//        if ($type->type == 1) {
//            return json_encode(array('success' => true, 'msg' => '登录成功，即将跳转到后台首页'));
//        }
//        else if ($type->type == 0) {
//            return json_encode(array('success' => false, 'msg' => '普通用户不能登录'));
//        } else {
//            return json_encode(array('success' => false, 'msg' => '用户名或密码错误'));
//        }
        if ($type->type == 0) {
            return json_encode(array('success' => false, 'msg' => '普通用户不能登录哦'));
        } else if (Auth::attempt(array('username' => $username, 'password' => $password), true)) {
            return json_encode(array('success' => true, 'msg' => '登录成功，即将跳转到后台首页'));
        } else {
            return json_encode(array('success' => false, 'msg' => '用户名或密码错误'));
        }
    }

    /**
     * 用户注销
     */
    public function Logout()
    {
        Auth::logout();
        return Redirect::to('/login');
    }
}