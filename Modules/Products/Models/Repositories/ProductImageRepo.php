<?php

namespace Modules\Products\Models\Repositories;

use Modules\Products\Models\Entities\ProductImage;

class ProductImageRepo
{

    public function all($product)
    {

        $productImages = ProductImage::where('id_product', $product)->get();

        return $productImages;
    }

    public function find($product, $image)
    {

        $productImage = ProductImage::with([
            'ProductRecords',
        ])->where([
            'id_archive' => $image,
            'id_product' => $product
        ])->first();

        return $productImage;
    }

    public function delete($id)
    {

        $productImage = ProductImage::destroy($id);

        return $productImage;
    }

    public function deleteAll($product)
    {

        $productImages = ProductImage::where('id_product', $product)->delete();

        return $productImages;
    }

    public function store($data)
    {

        $productImage = new ProductImage();
        $productImage->fill($data);
        $productImage->save();

        return $productImage;
    }

    public function update($productImage, $data)
    {

        $productImage->fill($data);
        $productImage->save();

        return $productImage;
    }

}
