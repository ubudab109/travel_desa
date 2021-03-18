<?php

namespace App\Listeners;

use App\Criteria\Earnings\EarningOfStoreCriteria;
use App\Repositories\EarningRepository;

class UpdateOrderEarningTable
{
    /**
     * @var EarningRepository
     */
    private $earningRepository;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(EarningRepository $earningRepository)
    {
        //
        $this->earningRepository = $earningRepository;
    }

    /**
     * Handle the event.
     *
     * @param object $event
     * @return void
     */
    public function handle($event)
   /* {
        if ($event->order->payment->status == 'Paid') {
            $this->earningRepository->pushCriteria(new EarningOfStoreCriteria($event->order->productOrders[0]->product->store->id));

            $store = $this->earningRepository->first();
            // test if order delivered to client
            $amount = 0;
            if (!empty($store)) {
                Flash::error('Stores not found');
            } else {
                foreach ($event->order->productOrders as $productOrder) {
                    $amount += $productOrder['price'] * $productOrder['quantity'];
                }
                $store->total_orders++;
                $store->store->admin_commission;
                $store->total_earning += $amount;
                $store->admin_earning += ($store->store->admin_commission / 100) * $amount;
                $store->store_earning += ($amount - $store->admin_earning);
                $store->delivery_fee += $event->order->delivery_fee;
                $store->tax += ($amount+$event->order->delivery_fee) * $event->order->tax / 100;
                $store->save();
            }
        }
    }*/
{
    if ($event->oldStatus != $event->order->payment->status) {
        $this->earningRepository->pushCriteria(new EarningOfStoreCriteria($event->order->productOrders[0]->product->store->id));
        $store = $this->earningRepository->first();
//            dd($store);
        $amount = 0;

        // test if order delivered to client
        if (!empty($store)) {
            foreach ($event->order->productOrders as $productOrder) {
                $amount += $productOrder['price'] * $productOrder['quantity'];
            }
            if ($event->order->payment->status == 'Paid') {
                $store->total_orders++;
                $store->total_earning += $amount;
                $store->admin_earning += ($store->store->admin_commission / 100) * $amount;
                $store->store_earning += ($amount - $store->admin_earning);
                $store->delivery_fee += $event->order->delivery_fee;
                $store->tax += $amount * $event->order->tax / 100;
                $store->save();
            } elseif ($event->oldStatus == 'Paid') {
                $store->total_orders--;
                $store->total_earning -= $amount;
                $store->admin_earning -= ($store->store->admin_commission / 100) * $amount;
                $store->store_earning -= $amount - (($store->store->admin_commission / 100) * $amount);
                $store->delivery_fee -= $event->order->delivery_fee;
                $store->tax -= $amount * $event->order->tax / 100;
                $store->save();
            }
        }

    }
}
}
