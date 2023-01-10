<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function listAllSeries(Request $request)
    {
        $series = [
            'Punisher',
            'Lost',
            'Modern Family'
        ];

        return response($series);
    }
}
