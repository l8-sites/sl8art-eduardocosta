<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Aws\S3\Exception\S3Exception;
use Aws\S3\S3Client;
use Carbon\Carbon;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        try {
            $client_id = env('VITE_API_CLIENT_ID');

            $allFiles = Storage::disk('s3_build')->allFiles("artistas/$client_id/build");

            $time = Carbon::now()->format('Y-m-dH:i:s');
            foreach($allFiles as $file){
                $tempFile = str_replace("artistas/$client_id/build", "artistas/$client_id/backup/build-".$time.'/', $file);
                Storage::disk('s3_build')->copy($file, $tempFile);
            }
            $allFiles = Storage::disk('s3_build')->allFiles("artistas/$client_id/backup/build-".$time);
            if(count($allFiles) > 0){
                Storage::disk('s3_build')->deleteDirectory("artistas/$client_id/build");
            }
        }catch(S3Exception $e){
            dd($e->getAwsErrorMessage());

        }
        // $schedule->command('inspire')->hourly();

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
