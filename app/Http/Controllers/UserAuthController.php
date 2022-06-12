<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

class UserAuthController extends Controller
{
    //
    public function showLogin($guard)
    {
        return response()->view('cms.auth.login', ['guard' => $guard]);
    }

    public function login(Request $request)
    {
        $validator = Validator($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
            'remember' => 'required|boolean',
            'guard' => 'required|string|in:admin,school,teacher'
        ], [
            'email.required' => 'رجاء, أدخل البريد الإلكتروني',
            'email.email' => 'البريد الإلكتروني المدخل غير صحيح',
            'password.required' => 'رجاء, أدخل كلمة المرور',
            'guard.in' => 'تأكد من صحة رابط صفحة تسجيل الدخول'
        ]);

        $credentials = [
            'email' => $request->get('email'),
            'password' => $request->get('password'),
        ];

        if (!$validator->fails()) {
            if (Auth::guard($request->get('guard'))->attempt($credentials, $request->get('remember'))) {
                return response()->json(['message' => 'Logged in successfully'], 200);
            } else {
                return response()->json(['message' => 'بيانات تسجيل الدخول غير صحيحة'], 400);
            }
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    public function editPassword()
    {
        return view('cms.auth.edit-password');
    }

    // public function updatePassword(Request $request)
    // {
    //     $validator = Validator($request->all(), [
    //         'current_password' => 'required|string|password:admin',
    //         'new_password' => 'required|string|confirmed',
    //         'new_password_confirmation' => 'required|string'
    //     ]);

    //     if (!$validator->fails()) {
    //         $user = Admin::findOrFail(Auth()->guard('admin')->user()->id);
    //         $user->password = Hash::make($request->get('new_password'));
    //         $isSaved = $user->save();
    //         return response()->json(['message' => $isSaved ? "تمت العملية بنجاح" : "فشلت العملية"], $isSaved ? 200 : 400);
    //     } else {
    //         return response()->json(['message' => $validator->getMessageBag()->first()], 400);
    //     }
    // }

    public function logout(Request $request)
    {
        Auth::guard()->logout();
        $request->session()->invalidate();
        return redirect()->route('cms.login', 'admin');
    }
}
