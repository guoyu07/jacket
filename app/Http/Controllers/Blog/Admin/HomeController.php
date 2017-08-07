<?php
/**
 * Created by PhpStorm.
 * User: caohui
 * Date: 2017/7/17
 * Time: 22:46
 */

namespace App\Http\Controllers\Blog\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;



class HomeController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('blog.admin.index');
    }
}