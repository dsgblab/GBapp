<?php

namespace App\Http\Controllers;

use App\Traits\PowerBITrait;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    use PowerBITrait;

    /**
     * @return Response
     * @throws GuzzleException
     */
    public function index()
    {
        $reports = auth()->user()->reports()->wherePivot('show', true)
            ->get()->map(function ($row){
                $row->token = $this->getReportAccessToken(Session::get('power_access_token')[0]->access_token, $row);
                $row->userAccessToken = Session::get('power_access_token')[0]->access_token;
                $row->embedUrl = "https://app.powerbi.com/reportEmbed?reportId=$row->reportId&groupId=$row->groupId";

                return $row;
            });

        return Inertia::render('Dashboard', [
            'reports' => $reports
        ]);
    }
}
