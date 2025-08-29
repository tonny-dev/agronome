<?php

namespace App\Jobs;

use App\Models\Kit;
use App\Services\InventoryService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ReleaseKitHoldJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(private int $kitId) {}

    public function handle(InventoryService $inventoryService)
    {
        $kit = Kit::find($this->kitId);
        
        if ($kit) {
            $inventoryService->releaseHold($kit);
        }
    }
}
