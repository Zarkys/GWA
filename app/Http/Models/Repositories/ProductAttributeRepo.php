<?php

namespace App\Http\Models\Repositories;

use Mockery\Matcher\Type;

use App\Http\Models\Entities\Product;  
use App\Http\Models\Entities\Attribute;
use App\Http\Models\Entities\ProductAttribute;
use App\Http\Models\Entities\TypeProductAttribute;
use Illuminate\Support\Facades\Log;
class ProductAttributeRepo
{
    public function all()
    {
        $productattribute = ProductAttribute::with([
                'Product', 'Attribute',
            ])->whereIn('active', [0, 1])->get();           
        return $productattribute;
    }
    public function filteractive()
    {
        //Find By parameters (Item)
        try {
           
            $productattribute = ProductAttribute::with([
                    'Product', 'Attribute',
                ])->whereIn('active', [1])->get();

            return $productattribute;

        } catch (\Exception $ex) {
            Log::error($ex);
            $response = [
                'status'  => 'FAILED',
                'code'    => 500,
                'message' => _('Ocurrio un error interno') . '.',
            ];

            return response()->json($response, 500);
        }
    }
        public function filterinactive()
    {
        //Find By parameters (Item)
        try {
           
            $productattribute = ProductAttribute::with([
                    'Product', 'Attribute',
                ])->whereIn('active', [0])->get();

            return $productattribute;

        } catch (\Exception $ex) {
            Log::error($ex);
            $response = [
                'status'  => 'FAILED',
                'code'    => 500,
                'message' => _('Ocurrio un error interno') . '.',
            ];

            return response()->json($response, 500);
        }
    }
        public function filterdeleted()
    {
        //Find By parameters (Item)
        try {
           
            $productattribute = ProductAttribute::with([
                    'Product', 'Attribute',
                ])->whereIn('active', [2])->get();

            return $productattribute;

        } catch (\Exception $ex) {
            Log::error($ex);
            $response = [
                'status'  => 'FAILED',
                'code'    => 500,
                'message' => _('Ocurrio un error interno') . '.',
            ];

            return response()->json($response, 500);
        }
    }
    public function findbyid($id)
    {

        $productattribute = ProductAttribute::find($id);

        return $productattribute;
    }
    public function getAttributesValue($idproduct)
    {
        try {
            $product = Product::find($idproduct);
           
            $type_products_attributes = TypeProductAttribute::with([
                'Attribute'
            ])->where('id_type_product','=',$product->id_type_product)->get();
            
           
            foreach($type_products_attributes as $types)
            {
                $ProductAttribute = ProductAttribute::where('id_product','=',$product->id)
                                            ->where('id_attribute',$types->id_attribute)->first();
                                           
                if($ProductAttribute != null)
                {
                    $types->value=$ProductAttribute->value;
                    $types->id_product_attribute = $ProductAttribute->id;
                }else {
                    $types->value='';
                    $types->id_product_attribute = 0;
                }
                
              
            
            }
            return $type_products_attributes;

    } catch (\Exception $ex) {
        Log::error($ex);
        $response = [
            'status'  => 'FAILED',
            'code'    => 500,
            'message' => _('Ocurrio un error interno') . '.',
        ];
        
        return response()->json($response, 500);
    } 
    }
    public function filterby($item,$id) {
            //Find By parameters (Item)
            try {
                    if($item==='id_product'){
                        //$productstation = ProductStation::where('id_product', $id)->get();

                        $productattribute = ProductAttribute::with([
                            'Product', 'Attribute',
                        ])->where('id_product', $id)->whereIn('active', [0, 1])->get();
                    }  
                    if($item==='id_attribute'){
                        $productattribute = ProductAttribute::with([
                            'Product', 'Attribute',
                        ])->where('id_attribute', $id)->whereIn('active', [0, 1])->get();
                    }                
                      
               
                    return $productattribute;

            } catch (\Exception $ex) {
                Log::error($ex);
                $response = [
                    'status'  => 'FAILED',
                    'code'    => 500,
                    'message' => _('Ocurrio un error interno') . '.',
                ];
                
                return response()->json($response, 500);
            } 
    } 

    public function store($data)
    {

        $productattribute = new ProductAttribute();
        $productattribute->fill($data);
        $productattribute->save();

        return $productattribute;
    }
    
    public function updateAttributes($productattribute, $idproduct)
    {
       
        $lenght = count($productattribute);
       
        Log::debug('cant:'.$lenght);
        Log::debug($productattribute);
        for($i=0; $i<$lenght; $i++)
      {
          $product = $productattribute[$i];
          
         
          if($product['id_product_attribute'] != 0)
          {
                Log::debug('Actualizar un product');
                $productatt = ProductAttribute::find($product['id_product_attribute']);                         
                $productatt['value'] = $product['value'];
                Log::debug($productatt);               
                $productatt->save();      
                
            }else{
                Log::debug('Creando un product nuevo');
                $productatt_new = new ProductAttribute();
                $datas['id_product'] = $idproduct;
                $datas['id_attribute'] = $product['id_attribute'];
                $datas['value'] = $product['value'];  
                Log::debug('valor de product: '.$product['value']);
                $datas['active'] = 1;
                $productatt_new->fill($datas);
                $productatt_new->save();
                $datas = [];
            }

           
    
            
      }
       

       // $productattribute->fill($data);
       // $productattribute->save();

        return $productattribute;
    }
    public function update($productattribute, $data)
    {

        $productattribute->fill($data);
        $productattribute->save();

        return $productattribute;
    }
        public function activate($productattribute, $data)
    {

        $productattribute->fill($data);
        $productattribute->save();

        return $productattribute;
    }
        public function inactivate($productattribute, $data)
    {

        $productattribute->fill($data);
        $productattribute->save();

        return $productattribute;
    }

    public function delete($productattribute, $data)
    {

        $productattribute->fill($data);
        $productattribute->save();

        return $productattribute;
    }

           public function checkduplicate($itemfirst,$stringfirst,$itemsecond,$stringsecond) {
            //Find By parameters (Item)
            try {
                    if($itemfirst==='id_product' && $itemsecond==='id_attribute')
                    {

                        $productattribute = ProductAttribute::where('id_product', $stringfirst)
                        ->where('id_attribute', $stringsecond)
                        ->whereIn('active', [0, 1])
                        -> exists();

                    } 
                    return $productattribute;

            } catch (\Exception $ex) {
                
                $response = [
                    'status'  => 'FAILED',
                    'code'    => 500,
                    'message' => _('Ocurrio un error internor') . '.',
                ];
                
                return response()->json($response, 500);
            } 
        } 
}
