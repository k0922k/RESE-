<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Models\Reservation;
use App\Mail\ReservationReminderMail;
use Carbon\Carbon;

class SendReservationReminder extends Command
{
    protected $signature = 'reminder:send';
    protected $description = 'Send reservation reminders for the day';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $today = Carbon::now()->format('Y-m-d');
        $reservations = Reservation::whereDate('date', $today)->get();

        if ($reservations->isEmpty()) {
            $this->info('No reservations found for today.');
            return;
        }

        foreach ($reservations as $reservation) {
            $user = $reservation->user;

            if ($user) {
                try {
                    Mail::to($user->email)->send(new ReservationReminderMail($reservation));
                    $this->info('Reminder sent to: ' . $user->email);
                } catch (\Exception $e) {
                    $this->error('Failed to send reminder to: ' . $user->email . ' - ' . $e->getMessage());
                }
            } else {
                $this->error('No user found for reservation ID: ' . $reservation->id);
            }
        }

        $this->info('Reservation reminders processed successfully.');
    }
}