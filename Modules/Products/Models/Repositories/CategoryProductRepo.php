<?php

namespace Modules\Products\Models\Repositories;

use Modules\Products\Models\Entities\CategoryProduct;
use Modules\Products\Models\Enums\ActiveCategory;

class CategoryProductRepo
{
    public function all()
    {

        $category = CategoryProduct::all();
        return $category;

    }

    public function allActiveCurrency($iso)
    {

        $categories = CategoryProduct::with([
            'Products' => function ($query) use ($iso){
                $query->where('currency',$iso)->with([
                    'TypeProduct',
                    'CategoryProduct',
                    'CurrencyProduct',
                    'AttributeProduct',
                    'ProductImages' => function ($query) {
                        $query->with(['ProductRecords']);
                    },
                ]);
            },
        ])->where(['active' => ActiveCategory::$activated])->get();

        return $categories;
    }

    public function allActive()
    {
        $categories = CategoryProduct::with([
            'Products' => function ($query) {
                $query->with([
                    'TypeProduct',
                    'CategoryProduct',
                    'CurrencyProduct',
                    'AttributeProduct'
                ]);
            },
        ])->where(['active' => ActiveCategory::$activated])->get();

        return $categories;
    }

    public function find($id)
    {

        $category = CategoryProduct::find($id);

        return $category;
    }

    public function slug($slug)
    {

        $category = CategoryProduct::with([
            'Products' => function ($query) {
                $query->with([
                    'TypeProduct',
                    'CategoryProduct',
                    'CurrencyProduct',
                    'AttributeProduct'
                ]);
            },
        ])->where('slug', $slug)->first();

        return $category;
    }

    public function slugCurrency($slug,$iso)
    {

        $categories = CategoryProduct::with([
            'Products' => function ($query) use ($iso){
                $query->where('currency',$iso)->orderBy('id','desc')->with([
                    'TypeProduct',
                    'CategoryProduct',
                    'CurrencyProduct',
                    'AttributeProduct',
                    'ProductImages' => function ($query) {
                        $query->with(['ProductRecords']);
                    },
                ]);
            },
        ])->where(['active' => ActiveCategory::$activated,'slug'=> $slug])->first();

        return $categories;
    }

    public function store($data)
    {

        $category = new CategoryProduct();
        $category->fill($data);
        $category->save();

        return $category;
    }

    public function update($category, $data)
    {

        $category->fill($data);
        $category->save();

        return $category;
    }

    public function delete($id)
    {

        $category = CategoryProduct::destroy($id);

        return $category;
    }

    public function findbyid($id)
    {

        $category = CategoryProduct::find($id);


        return $category;
    }

}
