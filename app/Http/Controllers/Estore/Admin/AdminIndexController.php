<?php

namespace App\Http\Controllers\Estore\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminIndexController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }
}
