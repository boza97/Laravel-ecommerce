<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index() {
        $newsRes = callAPI('GET', env('NEWS_API_URL').'top-headlines?country=rs&category=technology&apiKey='.env('NEWS_API_KEY'));

        $news = [];

        foreach ($newsRes->articles as $n) {
            // if($n->source->name == 'Srbijadanas.com') continue;
            if(in_array($n->source->name, ['Pink.rs', 'Srbijadanas.com'])) continue;

            $news[] = $n;
        }

        return view('news.index', compact('news'));
    }
}
