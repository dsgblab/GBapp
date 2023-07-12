<?php

namespace App\Http\Controllers;

use App\Models\Report;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class ReportController extends Controller
{
    /**
     * @var string|mixed
     */
    private string $userAccessToken = '';

    /**
     * Verifies that the user has sufficient permissions to access the methods
     * @throws GuzzleException
     */
    public function __construct()
    {
        $this->middleware(['role_or_permission:super-administrador|report.create'])->except('update', 'destroy');
        $this->middleware(['role_or_permission:super-administrador|report.edit'])->except('store', 'destroy');
        $this->middleware(['role_or_permission:super-administrador|report.destroy'])->only('update', 'store');

        if ($this->userAccessToken === '') {
            $this->userAccessToken = $this->getUserAccessToken();
        }
    }

    /**
     * @return Response
     */
    public function index()
    {
        if (auth()->user()->can('super-administrador')){
            $reports = Report::with('user')->get();
        }else {
            $reports = auth()->user()->reports;
        }

        return Inertia::render('Report', [
            'reports' => $reports
        ]);
    }

    /**
     * @param $groupId
     * @param $reportId
     * @return Response
     * @throws GuzzleException
     */
    public function view($groupId, $reportId)
    {
        if (auth()->user()->can('super-administrador')){
            $report = Report::with('user')
                ->where('group_id', '=', $groupId)
                ->where('report_id', '=', $reportId)
                ->first();
        }else {
            $report = auth()->user()->reports
                ->where('group_id', '=', $groupId)
                ->where('report_id', '=', $reportId)
                ->first();

            if (!$report){
                abort(403);
            }
        }

        $report->token = $this->getReportAccessToken($this->userAccessToken, $report);
        $report->userAccessToken = $this->userAccessToken;
        $report->embedUrl = "https://app.powerbi.com/reportEmbed?reportId=$reportId&groupId=$groupId";

        return Inertia::render('ViewReport', [
            'report' => $report
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $report = new Report($request->all());
        $report->user_id = Auth::id();
        $report->save();

        if (auth()->user()->can('super-administrador')){
            $reports = Report::with('user')->get();
        }else {
            $reports = auth()->user()->reports;
        }

        return response()->json($reports, 200);
    }

    /**
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        $report = Report::find($id);
        $report->update($request->all());
        $report->save();

        if (auth()->user()->can('super-administrador')){
            $reports = Report::with('user')->get();
        }else {
            $reports = auth()->user()->reports;
        }

        return response()->json($reports, 200);
    }

    /**
     * @return mixed
     * @throws GuzzleException
     */
    protected function getUserAccessToken()
    {
        $user_id = config('power-bi.user_id');

        $client = new Client([
            'base_uri' => "https://login.microsoftonline.com/$user_id/oauth2/token"
        ]);

        $response = $client->request('POST', "https://login.microsoftonline.com/$user_id/oauth2/token", [
            'multipart' => [
                [
                    'name' => 'resource',
                    'contents' => config('power-bi.resource')
                ],
                [
                    'name' => 'grant_type',
                    'contents' => config('power-bi.grant_type')
                ],
                [
                    'name' => 'client_secret',
                    'contents' => config('power-bi.client_secret'),
                ],
                [
                    'name' => 'client_id',
                    'contents' => config('power-bi.client_id')
                ],
            ],
        ]);

        return json_decode($response->getBody()->getContents())->access_token;
    }

    /**
     * @param $userAccessToken
     * @param $report
     * @return object
     * @throws GuzzleException
     */
    protected function getReportAccessToken($userAccessToken, $report)
    {
        try {
            $client = new Client([
                'base_uri' => "https://api.powerbi.com"
            ]);

            $headers = [
                "Authorization" => "Bearer $userAccessToken",
                "Content-type" => "application/json",
                "Accept" => "application/json"
            ];

            $params = (object)[
                "accessLevel" => $report->access_level,
                "datasetId" => $report->dataset_id
            ];

            $response = $client->request('POST', "https://api.powerbi.com/v1.0/myorg/groups/$report->group_id/reports/$report->report_id/GenerateToken", [
                'headers' => $headers,
                'json' => $params
            ]);

            $resp = json_decode($response->getBody()->getContents());

            return (object)[
                'status' => 200,
                'tokenId' => $resp->token_id,
                'token' => $resp->token,
                'expiration' => $resp->expiration
            ];
        }catch (\Exception $e){
            return (object)[
                'status' => 500,
                'message' => $e->getMessage()
            ];
        }
    }
}
