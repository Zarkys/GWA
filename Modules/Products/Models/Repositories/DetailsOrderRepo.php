<?php

namespace Modules\Products\Models\Repositories;


use Modules\Products\Models\Entities\DetailsOrder;

class DetailsOrderRepo
{

    public function allOrder($order)
    {

        $details = DetailsOrder::where('id_order', $order)->get();

        return $details;
    }

    public function allStatus($order = null, $status = [])
    {

        $details = DetailsOrder::where('id_order', $order)->whereIn('status', [$status])->get();

        return $details;
    }

    public function find($id)
    {

        $details = DetailsOrder::find($id);

        return $details;
    }

    public function delete($id)
    {

        $details = DetailsOrder::destroy($id);

        return $details;
    }

    public function store($data)
    {

        $details = new DetailsOrder();
        $details->fill($data);
        $details->save();

        return $details;
    }

    public function update($details, $data)
    {

        $details->fill($data);
        $details->save();

        return $details;
    }

}
