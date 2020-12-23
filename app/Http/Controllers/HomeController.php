<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //
    /**
     * index action verifying the GUARD to be procesed for the auth
     *
     * @return void
     */
    public function index()
    {
        $role = Auth::user()->role;
        $checkrole = explode(',', $role);
        if (in_array('admin', $checkrole))
        {
            return redirect('dog/indexadmin');
        }
        else
        {
            return redirect('pet/index');
        }
    }
}
