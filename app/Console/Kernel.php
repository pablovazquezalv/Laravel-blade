<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;
use App\Models\CodeAccess;
use App\Models\User;

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
            CodeAccess::truncate(); // Elimina todos los registros existentes
        
            $users = User::where('rol_id', 1)->get();
            
            foreach ($users as $user) {
                // Generar múltiples códigos de acceso para el usuario
                $codes = [];
                for ($i = 0; $i < 5; $i++) {
                    $codes[] = [
                        'code' => rand(100000, 999999),
                        'status' => 1,
                        'user_public_key' => $user->public_key,
                        //'user_private_key' => $user->private_key,
                        'user_id' => $user->id,
                        'expiration_date' => now()->addDays(1),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
        
                // Insertar los códigos en la base de datos en una sola operación
                CodeAccess::insert($codes);
            }

        })->everyTwentySeconds();
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
