<?php

namespace App\Observers;

use App\Models\DesignTask;
use Illuminate\Support\Facades\Auth;

class DesignTaskObserver
{
    /**
     * Handle the DesignTask "created" event.
     */
    public function created(DesignTask $designTask): void
    {
        $designTask->created_id = Auth::id();
        $designTask->updated_id = Auth::id();
    }

    /**
     * Handle the DesignTask "updated" event.
     */
    public function updated(DesignTask $designTask): void
    {
        $designTask->created_id = Auth::id();
        $designTask->updated_id = Auth::id();
    }
}
