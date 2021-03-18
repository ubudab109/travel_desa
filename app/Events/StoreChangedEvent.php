<?php

namespace App\Events;

use App\Models\Store;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class StoreChangedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $store;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Store $store)
    {
        //
        $this->store = $store;
    }

}
