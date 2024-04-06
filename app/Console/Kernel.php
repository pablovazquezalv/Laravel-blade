<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {
            // Lógica de la función que deseas ejecutar cada 15 segundos
            //ejecutar una funcion de mis apis
            //llamar a funcion de llenar tabla
            //Log::info('Se ejecutó la tarea programada');
            $appController = new \App\Http\Controllers\AppController();
            $appController->fillTableCodes();

            Log::info('Se ejecutó la tarea programada');

        })->everyFifteenSeconds();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
