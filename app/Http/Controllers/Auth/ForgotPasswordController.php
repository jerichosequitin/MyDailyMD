<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Password;
use Mail;
use Hash;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function showForgetPasswordForm()
    {
        return view('auth.forgot-password');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function submitForgetPasswordForm(Request $request)
    {
        return view('auth.forgot-password');
        $request->validate([
            'email'=>'required|email|exists:user,email'
        ]);

        $token = \Str::random(64);
        \DB::table('password_resets')->inserts([
            'email'=>$request->email,
            'token'=>$token,
            'created_at'=>Carbon::now(),
        ]);

        $action_link = route('reset.password.form',['token'=>$token, 'email'=>$request->email]);
        $body = "We have received a request to reset the password for <b>MyDailyMD</b> account associated with ".$request->email."
        . You can reset your password by clicking the link below.";

        \Mail::send('email-forgot-password', ['action_link'=>$action_link, 'body'=>$body], function($message) use ($request){
            $message->from('noreply@mydailymd.com', 'MyDailyMD');
            $message->to($request->email,'Your name')
                ->subject('Reset Password');
        });

        return back()->with('message', 'We have e-mailed your password reset link!');
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function showResetPasswordForm(Request $request, $token = null) {
        return view('auth.reset-password', ['token' => $token, 'email'=>$request->email]);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function submitResetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);

        $check_token = DB::table('password_resets')
            ->where([
                'email' => $request->email,
                'token' => $request->token
            ])
            ->first();

        if (!$check_token) {
            return back()->withInput()->with('error', 'Invalid token!');
        }

        $user = User::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);

        DB::table('password_resets')->where(['email' => $request->email])->delete();

        return redirect()->route('login')->with('message', 'Your password has been changed!');
    }

}
