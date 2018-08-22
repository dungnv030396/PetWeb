<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class UserProfileController extends Controller
{
    public function updateProfile()
    {
        $user = new User();
        $user->updateProfile($this);
        return back()->with('statusUpdateProfile', 'Chúc mừng bạn đã thay đổi thông tin cá nhân Thành Công!');
    }

    public function updateUserBankInfo(){
        $user = new User();
        $user->updateUserBankInfo($this);
        return back()->with('updateUserBankInfo', 'Chúc mừng bạn đã thay đổi thông tin cá nhân Thành Công!');
    }

    public function updatePassword(Request $request)
    {
        $this->validate(\request(), [
            'password' => 'required|confirmed|between:6,25',
        ], [
            'password.between' => 'Mật khẩu phải từ 6-25 kí tự!',
            'password.confirmed' => 'Xác nhận mật khẩu không chính xác! Xin mời nhập lại'
        ]);

        if (Hash::check(\request('oldpwd'), Auth::user()->password)) {

            Auth::user()->fill([
                'password' => Hash::make($request->password) //'password'--trong talble, $request->password-- trong view
            ])->save();

            return back()->with('statusUpdatePass', 'Chúc mừng bạn đã thay đổi mật khẩu Thành Công!');

        } else {
            return back()->withErrors('Mật khẩu hiện tại không chính xác!');

        }
    }

    public function updateAvatar(Request $request)
    {
        if ($request->hasFile('avatar')) {

            $avatar = $request->file('avatar');
            $fileExtension = $avatar->GetClientOriginalExtension();
            $filename = $avatar->getClientOriginalName();
            $allowedfileExtension = ['jpg', 'png','PNG','JPG'];
//            $followExtensions = ['jpg', 'PNG', 'JPEG', 'GIF', 'TIFF'];
            if (in_array($fileExtension, $allowedfileExtension)) {
                $filenameFinal = time().'.'.$filename;
                $id = Auth::user()->id;
                $user = User::find($id);
                $user->avatar = $filenameFinal;
                $user->save();
                $avatar->storeAs('public/avatar', $filenameFinal);
                return back()->with('statusUpdateAvatar', 'Cập nhật ảnh đại diện thành công');
            } else {
                return back()->with('errorFile','Chỉ chấp nhận file png và jpd, xin mời chọn lại');
            }
        }else{
            return back()->with('errorNull','xin mời chọn ảnh');
        }

    }
}
