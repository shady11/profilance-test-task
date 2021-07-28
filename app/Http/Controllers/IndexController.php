<?php

namespace App\Http\Controllers;

use App\Models\ShortenLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class IndexController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function shortenLink(Request $request)
    {
        $input['link'] = $request->link;
        $input['shorten'] = Str::random(6);

        $shorten_link = ShortenLink::create($input);

        $shorten_link->shorten_link = URL::to($shorten_link->shorten);

        if($shorten_link) {
            return response()->json($shorten_link, 200);
        }

        return response()->json('Что-то пошло не так!',500);
    }
}
