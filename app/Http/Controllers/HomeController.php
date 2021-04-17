<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function index()
    {
        $description = "This web application is a form of a Learning Management System (LMS) which allows students to perform actions such as taking a subject, submitting a task and allows the professors to manage subjects and tasks. The app is developed using Laravel 8 and Bootstrap. The template has been developed fully from scratch and no third party templating was used.";
        return view('pages.index')->with('description', $description);
    }

    public function contact()
    {
        $name = "Aharrat Mohamed";
        $neptun_code = "AHR9OI";
        $email = "mohamedaharrat1@gmail.com";

        return view('pages.contact', ['name' => $name, 'neptun_code' => $neptun_code, 'email' => $email]);
    }
}
