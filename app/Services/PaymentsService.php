<?php

namespace App\Services;

use App\Models\SoilTest;
use App\Models\Payment;

class PaymentsService
{
    public function initiateStkPush(SoilTest $soilTest, string $phoneNumber, string $gateway = 'mpesa')
    {
        $payment = $soilTest->payments()->create([
            'gateway' => $gateway,
            'amount' => $soilTest->total_price,
            'currency' => 'KES',
            'status' => 'initiated'
        ]);

        // Mock STK push - in production, integrate with actual payment gateway
        $payload = [
            'phone' => $phoneNumber,
            'amount' => $soilTest->total_price,
            'reference' => "SOIL-{$soilTest->id}-{$payment->id}",
            'description' => "Soil Test Payment for Farm: {$soilTest->farm->name}"
        ];

        if (config('app.env') === 'production') {
            // Actual MPesa/Airtel integration here
            $response = $this->callPaymentGateway($gateway, $payload);
        } else {
            // Mock response for development
            $response = [
                'status' => 'success',
                'external_ref' => 'MOCK-' . uniqid(),
                'checkout_request_id' => 'ws_CO_' . time()
            ];
        }

        $payment->update([
            'status' => 'prompt_sent',
            'external_ref' => $response['external_ref'] ?? null,
            'payload_json' => $payload
        ]);

        return $payment;
    }

    public function handleWebhook(array $payload)
    {
        $externalRef = $payload['external_ref'] ?? null;
        $status = $payload['status'] ?? 'failed';
        
        if (!$externalRef) {
            return false;
        }

        $payment = Payment::where('external_ref', $externalRef)->first();
        
        if (!$payment) {
            return false;
        }

        $payment->update(['status' => $status === 'success' ? 'confirmed' : 'failed']);
        
        if ($status === 'success') {
            $payment->soilTest->update(['payment_status' => 'confirmed']);
            $payment->soilTest->transitionTo('paid');
        }

        return true;
    }

    private function callPaymentGateway(string $gateway, array $payload)
    {
        // Implement actual gateway calls here
        return ['status' => 'success', 'external_ref' => uniqid()];
    }
}
