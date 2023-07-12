<?php

namespace App\Observers;

use App\Models\TypeDocumentIdentification;
use Illuminate\Support\Facades\Auth;

class TypeDocumentIdentificationObserver
{
    /**
     * Handle the TypeDocumentIdentification "created" event.
     */
    public function creating(TypeDocumentIdentification $typeDocumentIdentification): void
    {
        if (Auth::check()) {
            $typeDocumentIdentification->created_id = Auth::id();
            $typeDocumentIdentification->updated_id = Auth::id();
        }
    }

    /**
     * Handle the TypeDocumentIdentification "updated" event.
     */
    public function updated(TypeDocumentIdentification $typeDocumentIdentification): void
    {
        $typeDocumentIdentification->updated_id = Auth::id();
    }
}
