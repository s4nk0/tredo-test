<?php

namespace App\Services;

use Google\Client;
use Google\Service;
use Google\Service\FirebaseCloudMessaging;
use Illuminate\Support\Facades\Storage;

class GoogleService
{
    protected Client $client;

    public function __construct()
    {
        $this->client = new Client();
        $this->client->setAuthConfig(Storage::disk('local')->path('Google/tredo-test-7d015-e4ce4e4d0775.json'));
        $this->client->addScope(FirebaseCloudMessaging::FIREBASE_MESSAGING);
    }

    public function authorize()
    {
        return $this->client->authorize();
    }
}
