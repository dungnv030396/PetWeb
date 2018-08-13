<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class SupplierRegister extends Model
{
    public function registerToSupplier($th,$request){
        $th->validate(\request(), [
            'mem_name' => 'required',
            'phonenumber' => 'required|digits_between:10,11|numeric',
            'password' => 'required|confirmed|between:6,15',
            'address' => 'required',
            'card_number' => 'numeric|digits_between:12,16'
        ],
            [
                'password.between' => 'Mật khẩu phải từ 6-15 kí tự!',
                'password.confirmed' => 'Mật Khẩu xác nhận không chính xác',
                'phonenumber.digits_between' => 'Số điện thoại phải có 10-11 chữ số!',
                'phonenumber.numeric' => 'Số điện thoải không chưa kí tự khác chữ số!',
                'card_number.digits_between' => 'Số tài khoản phải có 12-16 chữ số!',
                'card_number.numeric' => 'Số tài khoản không chưa kí tự khác chữ số!'
            ]);
        $registerSup = SupplierRegister::where('user_id',Auth::user()->id)->first();
        $city_name = City::where('code',$request->city)->first()->name;
        //dd($registerSup);
        if ($registerSup){
            $registerSup->user_id = Auth::user()->id;
            $registerSup->email = request('emailid');
            $registerSup->name = request('mem_name');
            $registerSup->phoneNumber = request('phonenumber');
            $registerSup->gender = \request('gender');
            $registerSup->password = bcrypt(request('password'));
            $registerSup->address = request('address').','.$city_name;
            $registerSup->bank_name = request('bank_name');
            $registerSup->bank_username = request('bank_username');
            $registerSup->card_number = request('card_number');
            $registerSup->bank_branch = request('bank_branch');
            $registerSup->city_code = $request->city;
            if ($request->hasFile('avatar')) {

                $avatar = $request->file('avatar');
                $fileExtension = $avatar->GetClientOriginalExtension();
                $filename = $avatar->getClientOriginalName();
                $allowedfileExtension = ['pdf', 'jpg', 'png','PNG','JPG','PDF'];
//                $followExtensions = ['jpg', 'PNG', 'JPEG', 'GIF', 'TIFF'];
                if (in_array($fileExtension, $allowedfileExtension)) {
                    $filenameFinal = time().'.'.$filename;
                    $registerSup->chandung = $filenameFinal;
                    $avatar->storeAs('public/chandung', $filenameFinal);
                } else {
                    return [
                        'error' => true,
                        'code' => 'errorFile',
                        'message' => 'Chỉ chấp nhận file ảnh, xin mời chọn lại'
                    ];
                }
            }else{
                return [
                    'error' => true,
                    'code' => 'errorNull',
                    'message' => 'xin mời chọn ảnh'
                ];
            }

            if ($request->hasFile('cmnd')) {

                $avatar = $request->file('cmnd');
                $fileExtension = $avatar->GetClientOriginalExtension();
                $filename = $avatar->getClientOriginalName();
                $allowedfileExtension = ['pdf', 'jpg', 'png','PNG','JPG','PDF'];

//                $followExtensions = ['jpg', 'PNG', 'JPEG', 'GIF', 'TIFF'];
                if (in_array($fileExtension, $allowedfileExtension)) {
                    $filenameFinal = time().'.'.$filename;
                    $registerSup->cmnd = $filenameFinal;
                    $avatar->storeAs('public/cmnd', $filenameFinal);
                    $registerSup->save();
                    return [
                        'error' => false
                    ];
                } else {
                    return [
                        'error' => true,
                        'code' => 'errorFile',
                        'message' => 'Chỉ chấp nhận file ảnh, xin mời chọn lại'
                    ];
                }
            }else{
                return [
                    'error' => true,
                    'code' => 'errorNull',
                    'message' => 'xin mời chọn ảnh'
                ];
            }
        }else {
            $user = new SupplierRegister();
            $user->user_id = Auth::user()->id;
            $user->email = request('emailid');
            $user->name = request('mem_name');
            $user->phoneNumber = request('phonenumber');
            $user->gender = \request('gender');
            $user->password = bcrypt(request('password'));
            $user->address = request('address').','.$city_name;
            $user->bank_name = request('bank_name');
            $user->bank_username = request('bank_username');
            $user->card_number = request('card_number');
            $user->bank_branch = request('bank_branch');
            $user->city_code = $request->city;
            if ($request->hasFile('avatar')) {

                $avatar = $request->file('avatar');
                $fileExtension = $avatar->GetClientOriginalExtension();
                $filename = $avatar->getClientOriginalName();
                $allowedfileExtension = ['pdf', 'jpg', 'png','PNG','JPG','PDF'];

//                $followExtensions = ['jpg', 'PNG', 'JPEG', 'GIF', 'TIFF'];
                if (in_array($fileExtension, $allowedfileExtension)) {
                    $filenameFinal = time() . '.' . $filename;
                    $user->chandung = $filenameFinal;
                    $avatar->storeAs('public/chandung', $filenameFinal);
                } else {
                    return [
                        'error' => true,
                        'code' => 'errorFile',
                        'message' => 'Chỉ chấp nhận file ảnh, xin mời chọn lại'
                    ];
                }
            } else {
                return [
                    'error' => true,
                    'code' => 'errorNull',
                    'message' => 'xin mời chọn ảnh'
                ];
            }

            if ($request->hasFile('cmnd')) {

                $avatar = $request->file('cmnd');
                $fileExtension = $avatar->GetClientOriginalExtension();
                $filename = $avatar->getClientOriginalName();
                $allowedfileExtension = ['pdf', 'jpg', 'png','PNG','JPG','PDF'];

//                $followExtensions = ['jpg', 'PNG', 'JPEG', 'GIF', 'TIFF'];
                if (in_array($fileExtension, $allowedfileExtension)) {
                    $filenameFinal = time() . '.' . $filename;
                    $user->cmnd = $filenameFinal;
                    $avatar->storeAs('public/cmnd', $filenameFinal);
                    $user->save();
                    return [
                        'error' => false
                    ];
                } else {
                    return [
                        'error' => true,
                        'code' => 'errorFile',
                        'message' => 'Chỉ chấp nhận file ảnh, xin mời chọn lại'
                    ];
                }
            } else {
                return [
                    'error' => true,
                    'code' => 'errorNull',
                    'message' => 'xin mời chọn ảnh'
                ];
            }
        }
    }
}
