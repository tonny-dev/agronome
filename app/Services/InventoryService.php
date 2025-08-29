<?php

namespace App\Services;

use App\Models\Farm;
use App\Models\Vendor;
use App\Models\Kit;
use Carbon\Carbon;

class InventoryService
{
    public function rankVendorsByDistanceAndStock(Farm $farm, Carbon $pickupDate, Carbon $dropoffDate)
    {
        return Vendor::select('vendors.*')
            ->selectRaw('
                (6371 * acos(cos(radians(?)) * cos(radians(lat)) * 
                cos(radians(lng) - radians(?)) + sin(radians(?)) * 
                sin(radians(lat)))) AS distance
            ', [$farm->centroid_lat, $farm->centroid_lng, $farm->centroid_lat])
            ->withCount(['kits as available_kits_count' => function ($query) use ($pickupDate, $dropoffDate) {
                $query->where('status', 'available')
                      ->whereDoesntHave('soilTests', function ($q) use ($pickupDate, $dropoffDate) {
                          $q->whereBetween('pickup_at', [$pickupDate, $dropoffDate])
                            ->orWhereBetween('dropoff_at', [$pickupDate, $dropoffDate]);
                      });
            }])
            ->having('available_kits_count', '>', 0)
            ->orderBy('distance')
            ->get();
    }

    public function holdKit(Vendor $vendor, string $refType, int $refId, array $metadata = []): ?Kit
    {
        $kit = $vendor->availableKits()->first();
        
        if (!$kit) {
            return null;
        }

        $kit->hold($refType, $refId, $metadata);
        
        // Release hold after 15 minutes if not confirmed
        dispatch(new \App\Jobs\ReleaseKitHoldJob($kit->id))->delay(now()->addMinutes(15));
        
        return $kit;
    }

    public function releaseHold(Kit $kit)
    {
        if ($kit->status === 'held') {
            $kit->update(['status' => 'available']);
            $kit->inventoryLedgers()->create([
                'event' => 'release',
                'ref_type' => 'system',
                'ref_id' => 0,
                'metadata' => ['reason' => 'timeout']
            ]);
        }
    }
}
