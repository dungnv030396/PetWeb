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
        $this->validate(\request(), [
            'mem_name' => 'required',
            'emailid' => 'required|email',
            'phonenumber' => 'required|digits_between:10,15|numeric',
            'address' => 'required',
            'card_number' => 'required|numeric'
        ],
            [
                'phonenumber.digits_between' => 'Số điện thoại phải có 10-15 chữ số!',
                'phonenumber.numeric' => 'Số điện thoải không chưa kí tự khác chữ số!',
                'card_number.numeric' => 'Số tài khoản không chưa kí tự khác chữ số!'
            ]);
        $user = new User();
        $user->updateProfile();
        return back()->with('statusUpdateProfile', 'Chúc mừng bạn đã thay đổi thông tin cá nhân Thành Công!');
    }

    public function updatePassword(Request $request)
    {
        $this->validate(\request(), [
            'password' => 'required|confirmed|digits_between:6,15',
        ], [
            'password.digits_between' => 'Mật khẩu phải từ 6-15 kí tự!',
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

            $followExtensions = ['jpg', 'png', 'JPEG', 'GIF', 'TIFF'];
            if (in_array($fileExtension, $followExtensions)) {

                $filenameFinal = time().'.'.$filename;
                $id = Auth::user()->id;
                $user = User::find($id);
                $user->avatar = $filenameFinal;
                $user->save();
                $avatar->storeAs('public/avatar', $filenameFinal);

                //($avatar)->resize(225, 225)->save(public_path('/storage/app/'.$filenameFinal));

                return back()->with('statusUpdateAvatar', 'Cập nhật ảnh đại diện thành công');
            } else {
                return back()->with('errorFile','Chỉ chấp nhận file ảnh, xin mời chọn lại');
            }
        }else{
            return back()->with('errorNull','xin mời chọn ảnh');
        }

    }
}
