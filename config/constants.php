<?php
return [
    'AUTH_TOKEN' => base64_encode(env('VITE_API_CLIENT_ID').'-'.env('VITE_API_SECRET'))
];