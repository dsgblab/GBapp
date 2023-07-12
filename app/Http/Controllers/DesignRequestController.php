<?php

namespace App\Http\Controllers;

use App\Models\DesignRequest;
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

        return Inertia::render('Design/Request', [
            'requests' => $requests
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        try {
            DesignRequest::create($request->except('id'));

            $requests = DesignRequest::all();
            return response()->json($requests, 200);
        }catch (\Exception $e){
            return response()->json($e->getMessage(), 500);
        }
    }

    /**
     * @param Request $request
     * @param $id
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
        }catch (\Exception $e){
            return response()->json($e->getMessage(), 500);
        }
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        try {
            DesignRequest::destroy($id);

            $requests = DesignRequest::all();
            return response()->json($requests, 200);
        }catch (\Exception $e){
            return response()->json($e->getMessage(), 500);
        }
    }
}
