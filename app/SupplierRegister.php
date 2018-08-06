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
            'address' => 'required'
        ],
            [
                'phonenumber.digits_between' => 'Số điện thoại phải có 10-11 chữ số!',
                'phonenumber.numeric' => 'Số điện thoải không chưa kí tự khác chữ số!'
            ]);
        $registerSup = new SupplierRegister();
        $registerSup = SupplierRegister::where('user_id',Auth::user()->id)->first();
        //dd($registerSup);
        if ($registerSup){
            $registerSup->user_id = Auth::user()->id;
            $registerSup->email = request('emailid');
            $registerSup->name = request('mem_name');
            $registerSup->phoneNumber = request('phonenumber');
            $registerSup->gender = \request('gender');
            $registerSup->address = request('address');
            $registerSup->bank_name = request('bank_name');
            $registerSup->bank_username = request('bank_username');
            $registerSup->card_number = request('card_number');
            $registerSup->bank_branch = request('bank_branch');
            if ($request->hasFile('avatar')) {

                $avatar = $request->file('avatar');
                $fileExtension = $avatar->GetClientOriginalExtension();
                $filename = $avatar->getClientOriginalName();

                $followExtensions = ['jpg', 'PNG', 'JPEG', 'GIF', 'TIFF'];
                if (in_array($fileExtension, $followExtensions)) {
                    $filenameFinal = time().'.'.$filename;
                    $registerSup->chandung = $filenameFinal;
                    $avatar->storeAs('public/chandung', $filenameFinal);
                } else {
                    return back()->with('errorFile','Chỉ chấp nhận file ảnh, xin mời chọn lại');
                }
            }else{
                return back()->with('errorNull','xin mời chọn ảnh');
            }

            if ($request->hasFile('cmnd')) {

                $avatar = $request->file('cmnd');
                $fileExtension = $avatar->GetClientOriginalExtension();
                $filename = $avatar->getClientOriginalName();

                $followExtensions = ['jpg', 'PNG', 'JPEG', 'GIF', 'TIFF'];
                if (in_array($fileExtension, $followExtensions)) {
                    $filenameFinal = time().'.'.$filename;
                    $registerSup->cmnd = $filenameFinal;
                    $avatar->storeAs('public/cmnd', $filenameFinal);
                } else {
                    return back()->with('errorFile','Chỉ chấp nhận file ảnh, xin mời chọn lại');
                }
            }else{
                return back()->with('errorNull','xin mời chọn ảnh');
            }
            $registerSup->save();
        }else {
            $user = new SupplierRegister();
            $user->user_id = Auth::user()->id;
            $user->email = request('emailid');
            $user->name = request('mem_name');
            $user->phoneNumber = request('phonenumber');
            $user->gender = \request('gender');
            $user->address = request('address');
            $user->bank_name = request('bank_name');
            $user->bank_username = request('bank_username');
            $user->card_number = request('card_number');
            $user->bank_branch = request('bank_branch');
            if ($request->hasFile('avatar')) {

                $avatar = $request->file('avatar');
                $fileExtension = $avatar->GetClientOriginalExtension();
                $filename = $avatar->getClientOriginalName();

                $followExtensions = ['jpg', 'PNG', 'JPEG', 'GIF', 'TIFF'];
                if (in_array($fileExtension, $followExtensions)) {
                    $filenameFinal = time() . '.' . $filename;
                    $user->chandung = $filenameFinal;
                    $avatar->storeAs('public/chandung', $filenameFinal);
                } else {
                    return back()->with('errorFile', 'Chỉ chấp nhận file ảnh, xin mời chọn lại');
                }
            } else {
                return back()->with('errorNull', 'xin mời chọn ảnh');
            }

            if ($request->hasFile('cmnd')) {

                $avatar = $request->file('cmnd');
                $fileExtension = $avatar->GetClientOriginalExtension();
                $filename = $avatar->getClientOriginalName();

                $followExtensions = ['jpg', 'PNG', 'JPEG', 'GIF', 'TIFF'];
                if (in_array($fileExtension, $followExtensions)) {
                    $filenameFinal = time() . '.' . $filename;
                    $user->cmnd = $filenameFinal;
                    $avatar->storeAs('public/cmnd', $filenameFinal);
                } else {
                    return back()->with('errorFile', 'Chỉ chấp nhận file ảnh, xin mời chọn lại');
                }
            } else {
                return back()->with('errorNull', 'xin mời chọn ảnh');
            }
            $user->save();
        }
    }
}
