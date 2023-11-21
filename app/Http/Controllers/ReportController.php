<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Traits\PowerBITrait;
use Carbon\Carbon;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class ReportController extends Controller
{
    use PowerBITrait;

    /**
     * @var string|mixed
     */
    private string $userAccessToken = '';

    /**
     * Verifies that the user has sufficient permissions to access the methods
     *
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
        if (auth()->user()->can('super-administrador')) {
            $reports = Report::all();
        } else {
            $reports = auth()->user()->reports;
        }

        return Inertia::render('Report', [
            'reports' => $reports,
        ]);
    }

    /**
     * @param $groupId
     * @param $reportId
     * @return Response|void
     * @throws GuzzleException
     */
    public function view($groupId, $reportId)
    {
        if (auth()->user()->can('super-administrador')) {
            $report = Report::with('user', 'created_by', 'filters')
                ->where('group_id', '=', $groupId)
                ->where('report_id', '=', $reportId)
                ->first();
        } else {
            $report = auth()->user()->reports
                ->where('group_id', '=', $groupId)
                ->where('report_id', '=', $reportId)
                ->first();

            if (!$report) {
                abort(403);
            }
        }

        if ($report->token === null || Carbon::now() >= $report->expiration_date) {
            $token = $this->getReportAccessToken($this->userAccessToken, $report);

            if ($token->status === 200) {
                $report->token = $token->token;
                $report->expiration_date = $token->expiration;
                $report->save();

                $report->userAccessToken = $this->userAccessToken;
                $report->embedUrl = "https://app.powerbi.com/reportEmbed?reportId=$reportId&groupId=$groupId";

                return Inertia::render('ViewReport', [
                    'report' => $report,
                ]);
            } else {
                return redirect()->route('report.index')->dangerBanner($token->message);
            }
        } else {
            $report->userAccessToken = $this->userAccessToken;
            $report->embedUrl = "https://app.powerbi.com/reportEmbed?reportId=$reportId&groupId=$groupId";

            return Inertia::render('ViewReport', [
                'report' => $report,
            ]);
        }
    }

    /**
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $report = new Report($request->all());
        $report->user_id = Auth::id();
        $report->save();

        if (auth()->user()->can('super-administrador')) {
            $reports = Report::with('user', 'created_by', 'filters')->get();
        } else {
            $reports = auth()->user()->reports;
        }

        return response()->json($reports, 200);
    }

    /**
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        $report = Report::find($id);
        $report->update($request->all());
        $report->save();

        if (auth()->user()->can('super-administrador')) {
            $reports = Report::with('user', 'created_by', 'filters')->get();
        } else {
            $reports = auth()->user()->reports;
        }

        return response()->json($reports, 200);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        Report::destroy($id);

        if (auth()->user()->can('super-administrador')) {
            $reports = Report::with('user')->get();
        } else {
            $reports = auth()->user()->reports;
        }

        return response()->json($reports, 200);
    }
}
