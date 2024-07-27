<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;

class QrCodeValidationController extends Controller
{
    public function validateQrCode(Request $request)
    {
        $reservationId = $request->input('reservation_id');
        $reservation = Reservation::find($reservationId);

        if (!$reservation) {
            return response()->json(['status' => 'failed', 'message' => 'Invalid reservation ID']);
        }


        return response()->json(['status' => 'success', 'reservation' => $reservation]);
    }
}
