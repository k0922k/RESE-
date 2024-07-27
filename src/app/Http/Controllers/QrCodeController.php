<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\Reservation;

class QrCodeController extends Controller
{
    public function generate($reservationId)
    {
        $reservation = Reservation::find($reservationId);

        if (!$reservation) {
            abort(404, 'Reservation not found');
        }

        $qrCode = QrCode::size(300)->generate($reservationId);

        return view('user.qr_code', ['qrCode' => $qrCode, 'reservation' => $reservation]);
    }
}
