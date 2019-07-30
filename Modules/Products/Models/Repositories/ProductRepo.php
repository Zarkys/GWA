<?php

namespace Modules\Products\Models\Repositories;

use Modules\Products\Models\Entities\Product;

class ProductRepo
{

    public function all()
    {

        $products = Product::with([
            'TypeProduct',
            'CategoryProduct',
            'CurrencyProduct',
            'AttributeProduct',
            'AttributeProduct',
        ])->get();

        return $products;
    }

    public function filteractive()
    {
        //Find By parameters (Item)
        try {

            $product = Product::with([
                'TypeProduct', 'CategoryForProduct',
            ])->whereIn('active', [1])->get();

            return $product;

        } catch (\Exception $ex) {
            $response = [
                'status' => 'FAILED',
                'code' => 500,
                'message' => __('Ocurrio un error interno') . '.',
            ];

            return response()->json($response, 500);
        }
    }

    public function filterinactive()
    {
        //Find By parameters (Item)
        try {

            $product = Product::with([
                'TypeProduct', 'CategoryForProduct',
            ])->whereIn('active', [0])->get();

            return $product;

        } catch (\Exception $ex) {
            Log::error($ex);
            $response = [
                'status' => 'FAILED',
                'code' => 500,
                'message' => __('Ocurrio un error interno') . '.',
            ];

            return response()->json($response, 500);
        }
    }

    public function getProductsWithAttributes()
    {
        //Find By parameters (Item)
        try {

            $product = Product::whereIn('active', [1])->get();

            foreach ($product as $prod) {
                $attributes = ProductAttribute::with([
                    'Attribute',
                ])->where('id_product', $prod->id)->get();
                foreach ($attributes as $att) {
                    $prod[$att->attribute->name] = $att->value;

                }

            }

            return $product;

        } catch (\Exception $ex) {
            Log::error($ex);
            $response = [
                'status' => 'FAILED',
                'code' => 500,
                'message' => __('Ocurrio un error interno') . '.',
            ];

            return response()->json($response, 500);
        }
    }

    public function getProductWithAttributes($idproduct)
    {
        //Find By parameters (Item)
        try {

            $product = Product::find($idproduct);


            $attributes = ProductAttribute::with([
                'Attribute',
            ])->where('id_product', $product->id)->get();
            foreach ($attributes as $att) {
                $product[$att->attribute->name] = $att->value;

            }


            return $product;

        } catch (\Exception $ex) {
            Log::error($ex);
            $response = [
                'status' => 'FAILED',
                'code' => 500,
                'message' => __('Ocurrio un error interno') . '.',
            ];

            return response()->json($response, 500);
        }
    }

    public function filterdeleted()
    {
        //Find By parameters (Item)
        try {

            $product = Product::with([
                'TypeProduct', 'CategoryForProduct',
            ])->whereIn('active', [2])->get();

            return $product;

        } catch (\Exception $ex) {
            Log::error($ex);
            $response = [
                'status' => 'FAILED',
                'code' => 500,
                'message' => __('Ocurrio un error interno') . '.',
            ];

            return response()->json($response, 500);
        }
    }

    public function findbyid($id)
    {

        $product = Product::with([
            'TypeProduct', 'CategoryForProduct',
        ])->find($id);

        return $product;
    }

    public function filterby($item, $id)
    {
        //Find By parameters (Item)
        try {
            if ($item === 'id_type_product') {
                //$productstation = ProductStation::where('id_product', $id)->get();

                $product = Product::with([
                    'TypeProduct', 'CategoryForProduct',
                ])->where('id_type_product', $id)->whereIn('active', [0, 1])->get();
            }
            if ($item === 'id_category_for_product') {
                //$productstation = ProductStation::where('id_product', $id)->get();

                $product = Product::with([
                    'TypeProduct', 'CategoryForProduct',
                ])->where('id_category_for_product', $id)->whereIn('active', [0, 1])->get();
            }


            return $product;

        } catch (\Exception $ex) {
            Log::error($ex);
            $response = [
                'status' => 'FAILED',
                'code' => 500,
                'message' => __('Ocurrio un error interno') . '.',
            ];

            return response()->json($response, 500);
        }
    }

    public function findbyunique($item, $string)
    {
        //Find By parameters (Item)
        try {
            if ($item === 'name') {

                $product = Product::with([
                    'TypeProduct', 'CategoryForProduct',
                ])->where('name', $string)->whereIn('active', [0, 1])->get();
            }
            return $product;

        } catch (\Exception $ex) {

            $response = [
                'status' => 'FAILED',
                'code' => 500,
                'message' => __('Ocurrio un error internor') . '.',
            ];

            return response()->json($response, 500);
        }
    }

    public function store($data)
    {

        $product = new Product();
        $product->fill($data);
        $product->save();

        return $product;
    }

    public function update($product, $data)
    {

        $product->fill($data);
        $product->save();

        return $product;
    }

    public function activate($product, $data)
    {

        $product->fill($data);
        $product->save();

        return $product;
    }

    public function inactivate($product, $data)
    {

        $product->fill($data);
        $product->save();

        return $product;
    }

    public function delete($product, $data)
    {

        $product->fill($data);
        $product->save();

        return $product;
    }

    public function checkduplicate($itemfirst, $stringfirst, $itemsecond, $stringsecond)
    {
        //Find By parameters (Item)
        try {
            if ($itemfirst === 'name' && $itemsecond === 'id_type_product') {

                $product = Product::where('name', $stringfirst)
                    ->where('id_type_product', $stringsecond)
                    ->whereIn('active', [0, 1])
                    ->exists();

            }
            return $product;

        } catch (\Exception $ex) {

            $response = [
                'status' => 'FAILED',
                'code' => 500,
                'message' => __('Ocurrio un error internor') . '.',
            ];

            return response()->json($response, 500);
        }
    }
}
