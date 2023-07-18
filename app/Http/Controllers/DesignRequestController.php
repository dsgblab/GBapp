<?php

namespace App\Http\Controllers;

use App\Models\DesignPriority;
use App\Models\DesignRequest;
use App\Models\DesignState;
use App\Models\DesignTimeState;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class DesignRequestController extends Controller
{
    /**
     * @return Response
     */
    public function index()
    {
        $requests = DesignRequest::all();
        $priorities = DesignPriority::all();
        $time_states = DesignTimeState::all();
        $states = DesignState::all();
        $designers = User::where('type', '=', 'designer')->get();
        $customers = User::where('type', '=', 'customer')->get();
        $sellers = User::where('type', '=', 'seller')->get();

        return Inertia::render('Design/Request', [
            'requests' => $requests,
            'priorities' => $priorities,
            'time_states' => $time_states,
            'states' => $states,
            'designers' => $designers,
            'customers' => $customers,
            'sellers' => $sellers,
        ]);
    }

    /**
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        try {
            DesignRequest::create([
                'priority_id' => $request->priority_id,
                'designer_id' => $request->designer_id,
                'seller_id' => $request->seller_id,
                'customer_id' => $request->customer_id,
                'comments' => $request->comments,
                'reception_date' => Carbon::parse($request->reception_date),
                'tentative_date' => Carbon::parse($request->tentative_date),
                'real_date' => Carbon::parse($request->real_date),
                'delivery_date' => Carbon::parse($request->delivery_date),
                'customer_approved_date' => Carbon::parse($request->customer_approved_date),
                'estimated_arrival_sherpa_date' => Carbon::parse($request->estimated_arrival_sherpa_date),
                'time_state_id' => $request->time_state_id,
                'state_id' => $request->state_id,
                'observations' => $request->observations,
            ]);

            $requests = DesignRequest::all();

            return response()->json($requests, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    /**
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        try {
            $designRequest = DesignRequest::find($id);
            $designRequest->name = $request->name;
            $designRequest->update();

            $requests = DesignRequest::all();

            return response()->json($requests, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    /**
     * @return JsonResponse
     */
    public function destroy($id)
    {
        try {
            DesignRequest::destroy($id);

            $requests = DesignRequest::all();

            return response()->json($requests, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}
