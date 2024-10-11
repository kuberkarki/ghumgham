<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Travel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TourResource;
use App\Http\Resources\TravelResource;

class TravelController extends Controller
{
    public function index(Request $request)
    {
        $travels = Travel::where('is_public',true)->paginate();
        return TravelResource::collection($travels);
        // return $travels;
    }

    public function tours(Travel $travel)
    {
        $tours = $travel->tours()
            ->orderBy('starting_date')
            ->paginate();
        return TourResource::collection($tours);
        // return $travels;
    }
}
