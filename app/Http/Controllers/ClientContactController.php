<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientContact;
use App\Models\Client;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientContactController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(StoreClientContact $request, Client $client)
    {
        $validated = $request->validated();

        Contact::create($validated + ['client_id' => $client->id]);

        return response()->json('', 201);
    }
}
