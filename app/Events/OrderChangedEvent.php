<?php

namespace App\Events;

use App\Models\Order;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderChangedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $order;

    public $oldStatus;

    public $updatedOrder;

    /**
     * OrderChangedEvent constructor.
     * @param $order
     * @param $oldOrder
     * @param $updatedOrder
     *
     */
    public function __construct(Order $order,$oldStatus)
    {
        //
        $this->order = $order;
        $this->oldStatus = $oldStatus;
    }
}
