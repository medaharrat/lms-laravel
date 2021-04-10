<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;

class TeachersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() //FIX THIS | REDIRECT OR DO SOMETHING CREATIVE
    {
        $subjects = Subject::orderBy('name', 'asc')->get();
        return view('pages.teacher.index')->with('subjects', $subjects);
    }
}
