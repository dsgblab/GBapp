<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class ReportController extends Controller
{
    /**
     * @return Response
     */
    public function index()
    {
        return Inertia::render('Report');
    }
}
