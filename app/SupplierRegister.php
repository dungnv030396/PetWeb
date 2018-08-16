<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class SupplierRegister extends Model
{
    public function registerToSupplier($th, $request)
    {
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
        $registerSup = SupplierRegister::where('user_id', Auth::user()->id)->first();
        $city_name = City::where('code', $request->city)->first()->name;
        //dd($registerSup);
        if ($registerSup) {
            $registerSup->user_id = Auth::user()->id;
            $registerSup->email = request('emailid');
            $registerSup->name = request('mem_name');
            $registerSup->phoneNumber = request('phonenumber');
            $registerSup->gender = \request('gender');
            $registerSup->password = request('password');
            $registerSup->address = request('address') . ',' . $city_name;
            $registerSup->bank_name = request('bank_name');
            $registerSup->bank_username = request('bank_username');
            $registerSup->card_number = request('card_number');
            $registerSup->bank_branch = request('bank_branch');
            $registerSup->delete_flag =0;
            $registerSup->city_code = $request->city;
            if ($request->hasFile('avatar')) {

                $avatar = $request->file('avatar');
                $fileExtension = $avatar->GetClientOriginalExtension();
                $filename = $avatar->getClientOriginalName();
                $allowedfileExtension = ['pdf', 'jpg', 'png', 'PNG', 'JPG', 'PDF'];
//                $followExtensions = ['jpg', 'PNG', 'JPEG', 'GIF', 'TIFF'];
                if (in_array($fileExtension, $allowedfileExtension)) {
                    $filenameFinal = time() . '.' . $filename;
                    $registerSup->chandung = $filenameFinal;
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
                $allowedfileExtension = ['pdf', 'jpg', 'png', 'PNG', 'JPG', 'PDF'];

//                $followExtensions = ['jpg', 'PNG', 'JPEG', 'GIF', 'TIFF'];
                if (in_array($fileExtension, $allowedfileExtension)) {
                    $filenameFinal = time() . '.' . $filename;
                    $registerSup->cmnd = $filenameFinal;
                    $avatar->storeAs('public/cmnd', $filenameFinal);
                    $registerSup->save();
                    return [
                        'error' => false,
                        'user' => $registerSup
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
        } else {
            $user = new SupplierRegister();
            $user->user_id = Auth::user()->id;
            $user->email = request('emailid');
            $user->name = request('mem_name');
            $user->phoneNumber = request('phonenumber');
            $user->gender = \request('gender');
            $user->password = request('password');
            $user->address = request('address') . ',' . $city_name;
            $user->bank_name = request('bank_name');
            $user->bank_username = request('bank_username');
            $user->card_number = request('card_number');
            $user->bank_branch = request('bank_branch');
            $user->delete_flag =0;
            $user->city_code = $request->city;
            if ($request->hasFile('avatar')) {

                $avatar = $request->file('avatar');
                $fileExtension = $avatar->GetClientOriginalExtension();
                $filename = $avatar->getClientOriginalName();
                $allowedfileExtension = ['pdf', 'jpg', 'png', 'PNG', 'JPG', 'PDF'];

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
                $allowedfileExtension = ['pdf', 'jpg', 'png', 'PNG', 'JPG', 'PDF'];

                if (in_array($fileExtension, $allowedfileExtension)) {
                    $filenameFinal = time() . '.' . $filename;
                    $user->cmnd = $filenameFinal;
                    $avatar->storeAs('public/cmnd', $filenameFinal);
                    $user->save();
                    return [
                        'error' => false,
                        'user' => $user
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

    public function getListRegistrationFormsAjax($start, $length, $search, $oderColunm, $oderSortType, $draw)
    {
        $columns = [
            0 => 'id',
//            1 => 'status',
//            2 => 'user_id',
//            3 => 'admin_id',
//            4 => 'reportTo_id',
            4 => 'updated_at'
        ];
        $totalRegistration = SupplierRegister::count();
        if (empty($search)) {
            $supplierRegisters = SupplierRegister::where('delete_flag', 0)
                ->offset($start)
                ->limit($length)
                ->orderBy($columns[$oderColunm], $oderSortType)
                ->get();
            $totalFiltered = $totalRegistration;
        } else {
            $supplierRegisters = SupplierRegister::where('name', 'like', "%$search%")
                ->orwhere('email', 'like', "%$search%")
                ->orwhere('user_id', 'like', "%$search%")
                ->orWhere('updated_at', 'like', "%$search%")
                ->where('delete_flag', 0)
                ->offset($start)
                ->limit($length)
                ->orderBy($columns[$oderColunm], $oderSortType)
                ->get();
            $totalFiltered = $supplierRegisters->count();
        }
        $data = array();
        if ($supplierRegisters) {
            foreach ($supplierRegisters as $supplierRegister) {
                $nestedData = array();
                $nestedData['id'] = $supplierRegister->id;
                $nestedData['name'] = $supplierRegister->name;
                $nestedData['phone'] = $supplierRegister->phoneNumber;
                $nestedData['user_id'] = $supplierRegister->user_id;
                $nestedData['email'] = $supplierRegister->email;
                $nestedData['updated_at'] = $supplierRegister->updated_at->modify('+7 hours')->format('H:i:s d/m/Y');
                $nestedData['detailRegistration'] = '<a href="' . route('viewDetailRegistration', $supplierRegister->id) . '">Xem Chi Tiết</a>';
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw" => intval($draw),
            // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal" => intval($totalRegistration),
            // total number of records
            "recordsFiltered" => intval($totalFiltered),
            // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data" => $data
        );
        return $json_data;
    }

    public function viewDetailRegistration($registration_id)
    {
        $supplierRegister = SupplierRegister::find($registration_id);
        return $supplierRegister;
    }

    public function registrationProcess()
    {
        $registrationLists = SupplierRegister::find(request('id'));
        $user = User::find($registrationLists->user_id);
        $buttonValue = request('button');
        if ($buttonValue == 'accept') {
            $user->name = $registrationLists->name;
            $user->gender = $registrationLists->gender;
            $user->password = bcrypt($registrationLists->password);
            $user->phoneNumber = $registrationLists->phoneNumber;
            $user->city_code = $registrationLists->city_code;
            $user->phoneNumber = $registrationLists->phoneNumber;
            $user->address = $registrationLists->address;
            $user->card_number = $registrationLists->card_number;
            $user->bank_name = $registrationLists->bank_name;
            $user->bank_username = $registrationLists->bank_username;
            $user->bank_branch = $registrationLists->bank_branch;
            $user->roleId = 2;
            $user->save();
            $registrationLists->delete_flag = 1;
            $registrationLists->save();
            return true;
        }else{
            $registrationLists->delete_flag = 1;
            $registrationLists->save();
            return false;
        }
    }
}
