<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $reservations = new Reservation();
        $reservations = $reservations->get();

        return response()->json($reservations);
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
     * @param  int  $id
     *
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        if (!$reservations = DB::select("
            SELECT r.id AS id, cu.id AS customer_id, cu.first_name, cu.last_name, ci.description AS city, co.description AS country, t.number_of_days, t.departure_date
            FROM
            customers cu
            LEFT JOIN
            reservations r ON cu.id = r.customer_id
            LEFT JOIN
            trips t ON r.trip_id = t.id
            LEFT JOIN
            cities ci ON t.city_id = ci.id
            LEFT JOIN
            countries co ON ci.country_code = co.code
            WHERE cu.id = $id;
        ")) {
            return response()->json(['status' => false, 'response' => "Something went wrong while trying to retrieve the data."], 400);
        }

        return response()->json($reservations, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function edit(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reservation $reservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @param  Reservation  $reservationQuery
     *
     * @return JsonResponse
     */
    public function destroy(int $id, Reservation $reservationQuery): JsonResponse
    {
        if (!$reservation = $reservationQuery->find($id)) {
            return response()->json(["status" => false, "response" => "Reservation " . $id . " does not exist."], 500);
        }

        $reservation->delete();

        return response()->json(["status" => true, "response" => "The reservation has been deleted successfully."], 200);
    }
}
