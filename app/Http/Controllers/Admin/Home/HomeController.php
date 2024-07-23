<?php

namespace App\Http\Controllers\Admin\Home;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin.home.index', ['title' => 'Home']);
    }
}
