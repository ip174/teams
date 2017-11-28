<?php

namespace App\Http\Controllers\Admin;

use DB;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    private $resource = 'users';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth.admin');
    }

    
    public function index()
    {
        return view('admin.dashboard');
    }

    public function users()
    {
        return view('admin.users.user_list');
    }

    public function categories()
    {
        return view('admin.users.category_list');
    }

    public function viewUser()
    {
        return view('admin.users.view_user');
    }

 
}
