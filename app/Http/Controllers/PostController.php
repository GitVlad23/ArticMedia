<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function store(Request $request)
    {
        if($request->ajax())
        {
            $data = json_encode($request->all());

            $arrayData = json_decode($data);

            Post::create([
                'name' => $arrayData->name,
                'text' => $arrayData->text
            ]);

            return json_decode($data);
        }
    }
}
