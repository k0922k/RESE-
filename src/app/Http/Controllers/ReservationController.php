<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;

class ReservationController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $reservations = $user->reservations()->orderBy('created_at', 'desc')->get();

        return view('reservations.index', compact('reservations'));

    }

    public function update(Request $request, $reservation_id)
    {
        $request->validate([
            'reservation_date' => 'required|date',
            'reservation_time' => 'required',
            'number_of_people' => 'required|integer|min:1',
        ], [
            'reservation_date.required' => '予約日を入力してください。',
            'reservation_time.required' => '予約時間を入力してください。',
            'number_of_people.required' => '人数を入力してください。',
        ]);



        $reservation = Reservation::findOrFail($reservation_id);
        $reservation->reservation_date = $request->input('reservation_date');
        $reservation->reservation_time = $request->input('reservation_time');
        $reservation->number_of_people = $request->input('number_of_people');
        $reservation->save();

        return redirect()->route('mypage')->with('success', '予約を更新いたしました。');
    }

    public function cancel($reservation_id)
    {
        try {
            $reservation = Reservation::findOrFail($reservation_id);
            $reservation->delete();

            return redirect()->route('mypage')->with('success', '予約がキャンセルされました。');
        } catch (\Exception $e) {
            return redirect()->route('mypage')->with('error', '予約のキャンセルに失敗しました。');
        }
    }
}