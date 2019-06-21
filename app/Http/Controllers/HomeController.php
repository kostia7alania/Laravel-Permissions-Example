<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //Role::create(['name'=>'writer']);
      //  Permission::create(['name'=>'write post']);

        Role::create(['name'=>'writte']);
        Permission::create(['name'=>'edit post']);
        auth()->user()->givePermissionTo('edit post);

        return view('home');
    }
}
