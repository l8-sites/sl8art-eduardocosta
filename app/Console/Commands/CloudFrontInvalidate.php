<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Meema\CloudFront\Facades\CloudFront;

class CloudFrontInvalidate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cloudfront:invalidate';

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
            $client_id = env('VITE_API_CLIENT_ID');
            $result = CloudFront::invalidate(['/site/'.$client_id.'/build/*']);
            if($result->toArray()['@metadata']['statusCode'] === 200 || $result->toArray()['@metadata']['statusCode'] === 201){
                return Command::SUCCESS;
            }
            return Command::FAILURE;
        }catch(\Exception $e){
            return Command::FAILURE;
        }
    }
}
