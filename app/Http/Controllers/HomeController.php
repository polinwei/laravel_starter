<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserVerify;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Support\Facades\Log;
use App\Helpers\Logger;

class HomeController extends Controller
{
    // 歡迎頁面
    public function index()
    {
        return view('welcome');
    }

    /**
     * 有認證則導向 Dashboard 頁面, 否則導向 login 頁面
     */
    public function dashboard()
    {
        // 檢查是否已有認證成功
        if (Auth::check()) {
            Debugbar::debug(Auth::user());
            return view('dashboard');
        }
        toastr()->error('Oops! You have sign in first!', 'Oops!');

        return redirect()->route('login')
            ->with('message', 'Opps! You are not allowed to access')
            ->withErrors([
                'email' => 'Your provided credentials do not match in our records.',
            ])->onlyInput('email');
    }

    // 登入頁面
    public function login()
    {
        return view('login');
    }

    // 登入頁面
    public function jwtLogin()
    {
        return view('jwtLogin');
    }

    /**
     * 登入驗證 Email/Password 及導向頁面
     */
    public function authLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required'
        ]);
        Log::debug($request);
        Logger::debug($request,__FILE__,__LINE__);        

        $credentials = $request->only('email', 'password');
        $remember_me = $request->has('rememberMe') ? true : false;
        
        if (Auth::attempt($credentials, $remember_me) && !Auth::user()->is_email_verified) {
            auth()->logout();
            return redirect()->route('login')
                ->with('message', 'You need to confirm your account. We have sent you an activation code, please check your email.')
                ->withErrors([
                    'email' => 'Your provided credentials do not match in our records.',
                ])->onlyInput('email');
        }

        if (Auth::attempt($credentials, $remember_me)) {
            return redirect()->intended('dashboard')->withSuccess('You have successfully Signed in');
        }
              
        return back() // 回錯誤傳訊息到登入頁面
            ->with('message', 'Login credentials are not valid!')
            ->withErrors([
                'email' => 'Your provided credentials do not match in our records.',
            ])->onlyInput('email');;
    }

    /**
     * signOut
     * 登出系統 清除session 
     * @return void
     */
    public function signOut()
    {
        Session::flush();
        Auth::logout();

        return Redirect('login');
    }

    // 導向註冊頁面
    public function register()
    {
        return view('register');
    }

    // 建立註冊帳號
    public function customRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password',
        ]);

        // 建立帳號
        $data = $request->all();
        $createUser = $this->createUser($data);

        // 送出驗證信件到用戶信箱
        $token = Str::random(64);

        UserVerify::create([
            'user_id' => $createUser->id,
            'token' => $token
        ]);

        Mail::send('email.emailVerificationEmail', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Email Verification Mail');
        });

        //return redirect("login")->withSuccess('Great! You have successfully registered & logged in!');
        return redirect("login")->with('infoMessage', 'Great! You have successfully registered & Please Verify your email!'); // 回傳訊息到登入頁面
    }
    // 從信箱內文中的驗證帳號連結 回到 驗證帳號頁面
    public function verifyAccount($token)
    {
        $verifyUser = UserVerify::where('token', $token)->first();

        $message = 'Sorry your email cannot be identified.';

        if (!is_null($verifyUser)) {
            $user = $verifyUser->user;

            if (!$user->is_email_verified) {
                $verifyUser->user->is_email_verified = 1;
                $verifyUser->user->email_verified_at = now();
                $verifyUser->user->save();
                $message = "Your e-mail is verified. You can now login.";
            } else {
                $message = "Your e-mail is already verified. You can now login.";
            }
        }

        return redirect()->route('login')->with('message', $message);
    }

    public function JwtVerifyAccount($token)
    {
        $verifyUser = UserVerify::where('token', $token)->first();

        $message = 'Sorry your email cannot be identified.';

        if (!is_null($verifyUser)) {
            $user = $verifyUser->user;

            if (!$user->is_email_verified) {
                $verifyUser->user->is_email_verified = 1;
                $verifyUser->user->email_verified_at = now();
                $verifyUser->user->save();
                $message = "Your e-mail is verified. You can now login.";
            } else {
                $message = "Your e-mail is already verified. You can now login.";
            }
        }

        return redirect()->route('jwtLogin')->with('message', $message);
    }

    /**
     * createUser
     * 建立帳號
     * @param  mixed $data
     * @return void
     */
    public function createUser(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }

    /**
     * showForgetPasswordForm
     * 導向忘記密碼頁面
     * @return void
     */
    public function showForgetPasswordForm()
    {
        return view('auth.passwords.forgetPassword');
    }

    /**
     * submitForgetPasswordForm
     * 送出忘記密碼連結到信箱
     * @param  mixed $request
     * @return void
     */
    public function submitForgetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $token = Str::random(64);

        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        Mail::send('email.forgetPassword', ['email' => $request->email, 'token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        return back()->with('message', 'We have e-mailed your password reset link!');
    }

    /**
     * showResetPasswordForm
     * 從信箱內文中的重設密碼連結 回到 系統重設密碼頁面
     * @param  mixed $email
     * @param  mixed $token
     * @return void
     */
    public function showResetPasswordForm($email, $token)
    {
        return view('auth.passwords.forgetPasswordLink', ['email' => $email, 'token' => $token]);
    }

    /**
     * submitResetPasswordForm
     * 更新密碼
     * @param  mixed $request
     * @return void
     */
    public function submitResetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);

        // 與 table:password_reset_tokens 比對資料
        $updatePassword = DB::table('password_reset_tokens')
            ->where([
                'email' => $request->email,
                'token' => $request->token
            ])
            ->first();

        if (!$updatePassword) {
            return back()->withInput()->with('error', 'Invalid token!');
        }

        $user = User::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);

        DB::table('password_reset_tokens')->where(['email' => $request->email])->delete();

        return redirect('login')->with('message', 'Your password has been changed!');
    }
}
