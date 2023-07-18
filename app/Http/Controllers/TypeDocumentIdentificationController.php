<?php

namespace App\Http\Controllers;

use App\Models\TypeDocumentIdentification;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class TypeDocumentIdentificationController extends Controller
{
    /**
     * @return Response
     */
    public function index()
    {
        $type_document_identifications = TypeDocumentIdentification::all();

        return Inertia::render('TypeDocumentIdentification', [
            'type_document_identifications' => $type_document_identifications,
        ]);
    }

    /**
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        try {
            TypeDocumentIdentification::create($request->except('id'));

            $type_document_identifications = TypeDocumentIdentification::all();

            return response()->json($type_document_identifications, 200);
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
            $designState = TypeDocumentIdentification::find($id);
            $designState->name = $request->name;
            $designState->update();

            $type_document_identifications = TypeDocumentIdentification::all();

            return response()->json($type_document_identifications, 200);
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
            TypeDocumentIdentification::destroy($id);

            $type_document_identifications = TypeDocumentIdentification::all();

            return response()->json($type_document_identifications, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}
