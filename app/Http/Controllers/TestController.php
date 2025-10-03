<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function store(Request $request)
    {
        $request->validate([
            'contents' => 'required|array|min:1',
            'contents.*.content_title' => 'required|string|max:255',
            'contents.*.blogs' => 'required|array|min:1',
            'contents.*.blogs.*.title' => 'required|string|max:255',
            'contents.*.blogs.*.body' => 'required|string',
        ]);
    }

    public function show()
    {
        return view('show');
    }
}
