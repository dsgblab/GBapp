<?php

namespace App\Http\Controllers;

use App\Models\DesignPriority;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Throwable;

class DesignPriorityController extends Controller
{
    /**
     * @return Response
     */
    public function index()
    {
        $priorities = DesignPriority::all();

        return Inertia::render('Design/Priority', [
            'priorities' => $priorities
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        try {
            DesignPriority::create($request->except('id'));

            $priorities = DesignPriority::all();
            return response()->json($priorities, 200);
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
            $designPriority = DesignPriority::find($id);
            $designPriority->name = $request->name;
            $designPriority->update();

            $priorities = DesignPriority::all();
            return response()->json($priorities, 200);
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
            DesignPriority::destroy($id);

            $priorities = DesignPriority::all();
            return response()->json($priorities, 200);
        }catch (\Exception $e){
            return response()->json($e->getMessage(), 500);
        }
    }
}
