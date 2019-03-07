<?php
    
    namespace App\Http\Controllers\Api;
    
    use App\Http\Models\Repositories\TextRepo;
    use App\Http\Models\Repositories\SectionRepo;
    use Illuminate\Http\Request;
    use Illuminate\Routing\Controller as BaseController;
    use Illuminate\Support\Facades\Validator;
    use Illuminate\Support\Facades\Log;
    use Illuminate\Support\Facades\Session;
    class TextController extends BaseController {
        
        private $TextRepo;
        private $SectionRepo;
        
        public function __construct(TextRepo $TextRepo,  SectionRepo $SectionRepo) {
            
            $this->TextRepo = $TextRepo;
            $this->SectionRepo        = $SectionRepo;
        }
        
        public function index() {
            
            try {
                $text = $this->TextRepo->all();
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $text,
                ];
                
                return response()->json($response, 200);
                
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
        
        public function filteractive() {
            
            try {
                $text = $this->TextRepo->filteractive();
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $text,
                ];
                
                return response()->json($response, 200);
                
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
        public function filterinactive() {
            
            try {
                $text = $this->TextRepo->filterinactive();
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $text,
                ];
                
                return response()->json($response, 200);
                
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
        public function filterdeleted() {
            
            try {
                $text = $this->TextRepo->filterdeleted();
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $text,
                ];
                
                return response()->json($response, 200);
                
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
        
        public function filterby($item, $id) {
            
            try {
                $text = $this->TextRepo->filterby($item, $id);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $text,
                ];
                
                return response()->json($response, 200);
                
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
        
        public function findbyid($id) {
            
            try {
                $text = $this->TextRepo->findbyid($id);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $text,
                ];
                
                return response()->json($response, 200);
                
            } catch (\Exception $ex) {
                $response = [
                    'status'  => 'FAILED',
                    'code'    => 500,
                    'message' => _('Ocurrio un error interno') . '.',
                ];
                
                return response()->json($response, 500);
            }
            
        }

         public function findbyunique($item, $string) {
            
            try {
                $text = $this->TextRepo->findbyunique($item,$string);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $text,
                ];
                
                return response()->json($response, 200);
                
            } catch (\Exception $ex) {
                $response = [
                    'status'  => 'FAILED',
                    'code'    => 500,
                    'message' => _('Ocurrio un error interno') . '.',
                ];
                
                return response()->json($response, 500);
            }
            
        }
        
        public function save(Request $request) {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'value_es' => 'required',
                'value_en' => 'required',
                'id_section' => 'required',
            ], $this->custom_message());
            
            if ($validator->fails()) {
                $response = [
                    'status'  => 'FAILED',
                    'code'    => 400,
                    'message' => __('Parametros incorrectos'),
                    'data'    => $validator->errors()->getMessages(),
                ];
                
           

                return response()->json($response);
            }
            try {
                
                $data = [
                    'name' => $request->get('name'),
                    'value_es' => $request->get('value_es'),
                    'value_en' => $request->get('value_en'),
                    'id_section' => $request->get('id_section'),
                    'active'     => 1,
                ];
              $itemfirst = 'name';
              $stringfirst = $data['name'];
              $itemsecond = 'id_section';
              $stringsecond = $data['id_section'];
              $TextDuple = $this->TextRepo->checkduplicate($itemfirst,$stringfirst,$itemsecond,$stringsecond);
             

           if ($TextDuple==0) { 
                
                
                $text = $this->TextRepo->store($data);
                $response       = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('El texto ha sido registrado correctamente'),
                    'data'    => $text,
                ];
                
                return response()->json($response, 200);

                    }
            else
            {
                $response = [
                    'status'  => 'FAILED',
                    'code'    => 409,
                    'message' => _('El texto fue registrado anteriormente') . '.',
        
                ];
        
                return response()->json($response, 409); 
            }
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
        
        public function update(Request $request, $id) {
            
            Log::debug($request);
            $text = $this->TextRepo->findbyid($id);
            
            
            if ($request->has('name')) {
                $data['name'] = $request->get('name');
            }
            if ($request->has('value_es')) {
                $data['value_es'] = $request->get('value_es');
            }
            if ($request->has('value_en')) {
                $data['value_en'] = $request->get('value_en');
            }
            if ($request->has('id_section')) {
                $data['id_section'] = $request->get('id_section');
            }
            if ($request->has('active')) {
                $data['active'] = $request->get('active');
            }
            
            try {
              $itemfirst = 'name';
              $stringfirst = $data['name'];
              $itemsecond = 'id_section';
              $stringsecond = $data['id_section'];
              $TextDuple = $this->TextRepo->checkduplicateUpdate($itemfirst,$stringfirst,$itemsecond,$stringsecond,$id);
             

            if ($TextDuple==0) {
                $text = $this->TextRepo->update($text, $data);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('El texto fue modificado correctamente '),
                    'data'    => $text,
                ];
                
                return response()->json($response, 200);
                  }
            else
            {
                $response = [
                    'status'  => 'FAILED',
                    'code'    => 409,
                    'message' => _('El texto fue registrado  anteriormente') . '.',
        
                ];
        
                return response()->json($response, 409); 
            }
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
        public function change($id, Request $request) {
            
            
            try {
                
                $text = $this->TextRepo->findbyid($id);

                if($text->active === 0)
                {
                    $text = $this->TextRepo->update($text, ['active' => 1]);
                }
                else
                {
                    $text = $this->TextRepo->update($text, ['active' => 0]);
                }
                
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('El producto fue cambiado correctamente '),
                    'data'    => $text,
                ];
                
                return response()->json($response, 200);
                
                
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
        
        public function delete($id, Request $request) {
            
            
            try {
                
                $text = $this->TextRepo->findbyid($id);
                $text = $this->TextRepo->delete($text, ['active' => 2]);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('El texto fue eliminado correctamente'),
                    'data'    => $text,
                ];
                
                return response()->json($response, 200);
                
                
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

       
       
        
        
        public function custom_message() {
            return [
                'name.required' => __('El nombre es requerido'),
                'value.required' => __('El valor o contenido es requerido'),
                'id_section.required' => __('La seccion es requerida'),
            ];
        }
        
    }
