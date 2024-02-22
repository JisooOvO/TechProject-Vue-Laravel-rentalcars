<?php

namespace App\Listeners;

use App\Events\ReservationUpdated;
use App\Models\Car;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateAvailableCarsCount implements ShouldQueue
{
    use InteractsWithQueue;
    /**
     * Handle the event.
     *
     * @param  \App\Events\ReservationUpdated  $event
     * @return void
     */
    public function handle(ReservationUpdated $event)
    {
        $car = Car::find($event->carId);
        $car->available_quantity--;
        $car->save();
    }
}
