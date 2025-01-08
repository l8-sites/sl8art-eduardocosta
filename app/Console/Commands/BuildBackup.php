<?php

namespace App\Console\Commands;

use Aws\S3\Exception\S3Exception;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class BuildBackup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 's3:build-backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            $client_id = config('app.client_id');

            $allFiles = Storage::disk('s3_build')->allFiles("site/$client_id/build");

            $time = Carbon::now()->format('Y-m-dH:i:s');
            foreach($allFiles as $file){
                $tempFile = str_replace("site/$client_id/build", "site/$client_id/backup/build-".$time.'/', $file);
                Storage::disk('s3_build')->copy($file, $tempFile);
            }

            $allFiles = Storage::disk('s3_build')->allFiles("site/$client_id/backup/build-".$time);
            if(count($allFiles) > 0){
                Storage::disk('s3_build')->deleteDirectory("site/$client_id/build");
            }
        }catch(S3Exception $e){
            dd($e->getAwsErrorMessage());

        }
    }
}
