<?php

namespace Modules\Products\Models\Repositories;

use Modules\Products\Models\Entities\Order;

class OrderRepo
{

    public function all()
    {

        $orders = Order::with(['Details', 'User'])->get();

        return $orders;
    }

    public function find($id)
    {

        $orders = Order::with(['Details', 'User'])->where('id', $id)->first();

        return $orders;
    }

    public function allStatus($status = [])
    {

        $orders = Order::with([
            'Details' => function ($query) {
                $query->with([
                    'Product' => function ($query) {
                        $query->with([
                            'CurrencyProduct'
                        ]);
                    },
                ]);
            }, 'User'])->whereIn('status', [$status])->get();

        return $orders;
    }

    public function delete($id)
    {

        $data = Order::with(['Details'])->destroy($id);

        return $data;
    }

    public function store($data)
    {

        $order = new Order();
        $order->fill($data);
        $order->save();

        return $order;
    }

    public function update($order, $data)
    {

        $order->fill($data);
        $order->save();

        return $order;
    }

}
