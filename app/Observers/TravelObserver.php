<?php

namespace App\Observers;

use App\Models\Travel;
use Illuminate\Support\Facades\Hash;

class TravelObserver
{
    /**
     * Handle the Travel "created" event.
     */
    public function creating(Travel $travel): void
    {
        // $travel->slug= str($travel->name)->slug();
        // $travel->password=Hash::make($travel->password);
    }

}
