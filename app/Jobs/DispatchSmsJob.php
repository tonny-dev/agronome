<?php

namespace App\Jobs;

use App\Models\DepthResult;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class DispatchSmsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;

    public function __construct(private int $depthResultId) {}

    public function handle()
    {
        $depthResult = DepthResult::find($this->depthResultId);
        
        if (!$depthResult) {
            return;
        }

        try {
            $smsData = [
                'sample_id' => $depthResult->sampleLocation->id,
                'depth_type' => $depthResult->depth_type,
                'lat' => $depthResult->sampleLocation->lat,
                'lng' => $depthResult->sampleLocation->lng,
                'elevation' => $depthResult->sampleLocation->elevation_m,
                'soil_data' => $depthResult->soil_json,
                'ambient_data' => $depthResult->ambient_json,
                'timestamp' => $depthResult->device_ts->toISOString()
            ];

            // Mock SMS dispatch - replace with actual SMS service
            if (config('app.env') === 'production') {
                $response = Http::post(config('services.sms.endpoint'), $smsData);
                $success = $response->successful();
            } else {
                // Mock success for development
                $success = true;
            }

            $depthResult->update([
                'sms_dispatch_status' => $success ? 'sent' : 'failed'
            ]);

        } catch (\Exception $e) {
            $depthResult->update(['sms_dispatch_status' => 'failed']);
            throw $e;
        }
    }
}
