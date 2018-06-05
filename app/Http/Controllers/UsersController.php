<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Mail;
use App\Http\Requests\UserRequest;
use App\Handlers\ImageUploadHandler;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', [
            // 无需登录可访问
            'except' => ['show', 'create', 'store', 'index', 'confirmEmail']
        ]);
    }

    public function index()
    {
        $users = User::paginate(10);
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:16',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|confirmed|min:6',
            'captcha' => 'required|captcha',
        ], [
            'captcha.required' => '验证码不能为空',
            'captcha.captcha' => '请输入正确的验证码',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $this->sendEmailConfirmationTo($user);
        session()->flash('success', '验证邮件已发送到您的注册邮箱上，请注意查收。');
        return redirect('/');
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user);
        return view('users.edit', compact('user'));
    }

    public function update(User $user, UserRequest $request)
    {
        $this->authorize('update', $user);

        $data = [];
        $data['name'] = $request->name;
        $data['introduction'] = $request->introduction;

        $user->update($data);
        session()->flash('success', '个人资料更新成功');

        return redirect()->route('users.show', $user->id);
    }

    public function destroy(User $user)
    {
        $this->authorize('destroy', $user);
        $user->delete();
        session()->flash('success', '成功删除用户！');
        return back();
    }

    protected function sendEmailConfirmationTo($user)
    {
        $view = 'emails.confirm';
        $data = compact('user');
        $name = 'truesnow';
        $to = $user->email;
        $subject = "感谢注册 SleepEatCode！请确认您的邮箱。";

        Mail::send($view, $data, function ($message) use ($to, $subject) {
            $message->to($to)->subject($subject);
        });
    }

    public function confirmEmail($token)
    {
        $user = User::where('activation_token', $token)->firstOrFail();

        $user->activated = true;
        $user->activation_token = null;
        $user->save();

        Auth::login($user);
        session()->flash('success', '恭喜您，激活成功！');

        return redirect()->route('users.show', compact('user'));
    }

    public function editAvatar(Request $request, User $user)
    {
        $this->authorize('update', $user);

        return $this->view('users.edit-avatar', compact('user'));
    }

    public function updateAvatar(Request $request, User $user, ImageUploadHandler $uploader)
    {
        $this->validate($request, [
            'avatar' => 'required|mimes:jpeg,png,bmp,gif|dimensions:min_width=200,min_height=200',
        ], [
            'avatar.required' => '头像不能为空',
        ]);
        $this->authorize('update', $user);
        $data = $request->all();
        if ($request->avatar) {
            $result = $uploader->save($request->avatar, 'avatars', $user->id, 362);
            if ($result) {
                $data['avatar'] = $result['path'];
            }
        }
        $user->update($data);

        return redirect()->route('users.show', $user->id)->with('success', '更新头像成功！');
    }

    public function editPassword(Request $request, User $user)
    {
        $this->authorize('update', $user);
        return $this->view('users.edit-password', compact('user'));
    }

    public function updatePassword(Request $request, User $user)
    {
        $this->validate($request, [
            'password' => 'required|confirmed|min:6',
        ]);
        $this->authorize('update', $user);
        $user->update(['password' => bcrypt($request->password)]);

        return redirect()->route('users.show', $user->id)->with('success', '更新密码成功！');
    }

    public function messages(User $user)
    {
        $messages = $user->messages()->orderBy('created_at', 'desc')->paginate(10);

        return $this->view('users.messages', compact('user', 'messages'));
    }

    public function articles(User $user)
    {
        $articles = $user->articles()->with('subject')->orderBy('created_at', 'desc')->paginate(10);

        return $this->view('users.articles', compact('user', 'articles'));
    }

    public function replies(User $user)
    {
        $replies = $user->replies()->with('article')->recent()->paginate(20);

        return $this->view('users.replies', compact('user', 'replies'));
    }
}
