<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        dd(parse_url('postgres://gpmeumgbpdxjll:06c927b6f29508b9b26f8c1a1de17e2025c746bd98b5ff8403ffb0c01790fe76@ec2-52-207-47-210.compute-1.amazonaws.com:5432/d1du0rofv84i1c'));
    }
}
