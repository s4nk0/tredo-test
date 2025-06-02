<?php

namespace App\Services;

use Exception;
use Google\Client;
use Google\Service\FirebaseCloudMessaging;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Psr\Http\Message\ResponseInterface;

class FirebaseService
{
    protected $url;

    public function __construct(protected GoogleService $googleService)
    {
        $project = config('services.firebase.projectId');
        $this->url = "https://fcm.googleapis.com/v1/projects/$project/";
     }

    public function send($token,$title,$body):ResponseInterface
    {
        $apiKey= config('services.firebase.apiKey');

        $url = $this->url."messages:send?key=$apiKey";

        $data = [
            'message'=>[
                'token'=>$token,
                'notification'=>[
                    'title'=>$title,
                    'body'=>$body,
                ]
            ]
        ];
        $response = null;
        try {
            $response = $this->googleService->authorize()->post($url, [
                'json'=>$data
            ]);

        } catch (Exception $e) {
            Log::error($e->getMessage());
        }

        if (isset($response) && $response->getStatusCode() != 200){
            Log::error($response->getBody()->getContents());
        }

        return $response;
    }
}
