<?php

namespace App\Http\Controllers;

use App\Services\PaymentsService;
use Illuminate\Http\Request;

class PaymentWebhookController extends Controller
{
    public function __construct(private PaymentsService $paymentsService) {}

    public function handle(Request $request)
    {
        $success = $this->paymentsService->handleWebhook($request->all());
        
        return response()->json(['success' => $success]);
    }
}
