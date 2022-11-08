<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Trip;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        if (!$allTrips = \DB::select('
            SELECT  t.id, t.city_id ,c.description AS city, co.description, t.number_of_days, t.departure_date, t.price, t.created_at
            FROM
            trips t  
            LEFT JOIN   
            cities c ON t.city_id = c.id 
            LEFT JOIN 
            countries co ON c.country_code = co.code
            ORDER BY price ASC; 
        ')) {
            return response()->json(['status' => false, 'response' => "Something went wrong while trying to retrieve the data."], 400);
        }

        return response()->json($allTrips, 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function topten(): JsonResponse
    {
        if (!$topTen = \DB::select('
        SELECT  co.description AS country, COUNT(*) AS numCities
        FROM
        reservations r
        LEFT JOIN
        trips t ON r.trip_id = t.id
        LEFT JOIN
        cities c ON t.city_id = c.id
        LEFT JOIN
        countries co ON c.country_code = co.code
        GROUP BY co.description
        ORDER BY numCities DESC
        LIMIT 10;
        ')) {
            return response()->json(['status' => false, 'response' => "Something went wrong while trying to retrieve the data."], 400);
        }

        return response()->json($topTen, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Trip  $Trip
     * @return \Illuminate\Http\Response
     */
    public function show(Trip $Trip)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Trip  $Trip
     * @return \Illuminate\Http\Response
     */
    public function edit(Trip $Trip)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Trip  $Trip
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Trip $Trip)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Trip  $Trip
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trip $Trip)
    {
        //
    }
}
