<?php

namespace App\Http\Controllers\Contact;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactMessageRequest;
use App\Models\Contact;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    public function storeMessage(ContactMessageRequest $request): JsonResponse
    {
        if ($request->validated()) {
            Contact::create($request->validated());
            return response()->json([
                'message' => 'Message sent successfully',
            ], 200);
        } else {
            return response()->json([
                'message' => 'An error occurred, Please try again later.'
            ], 500);
        }
    }

    public function messages(): JsonResponse
    {
        $messages = DB::table('contacts')->get();
        return response()->json([
            'messages' => $messages
        ], 200);
    }
}
