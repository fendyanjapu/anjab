<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Alert;

class adminController extends Controller
{
    public function index()
    {
        return view('admin/admin');
    }
}
