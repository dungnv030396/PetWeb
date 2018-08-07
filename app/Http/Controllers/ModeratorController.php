<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Session;

class ModeratorController extends Controller
{
    public function loginView(){
        return view('ModeratorView.login');
    }
}
