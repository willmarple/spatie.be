<?php

namespace App\Http\Controllers\Tools\Operators;

use App\Operators\Operators;
use Illuminate\Routing\Controller;

class OperatorsController extends Controller
{
    public function index(Operators $operators)
    {
        $pages = $operators->pagesByCategory();

        return view('front.pages.tools.operators.index', compact('pages'));
    }

    public function show(string $slug, Operators $operators)
    {
        $page = $operators->page($slug);

        abort_unless($page !== null, 404);

        return view('front.pages.tools.operators.show', compact('page'));
    }
}