<?php
    
    namespace App\Http\Controllers\Api;
    
    use App\Http\Models\Repositories\ArchiveRepo;
    use Illuminate\Http\Request;
    use Illuminate\Routing\Controller as BaseController;
    use Illuminate\Support\Facades\Validator;
    use Illuminate\Support\Facades\Log;
    class ArchiveController extends BaseController {
        
        private $ArchiveRepo;
        
        public function __construct(ArchiveRepo $ArchiveRepo) {
            
            $this->ArchiveRepo = $ArchiveRepo;
        }
        
        public function index() {
            
            try {
                $archive = $this->ArchiveRepo->all();
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $archive,
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
        
             public function indexactive() {
            
            try {
                $archive = $this->ArchiveRepo->filteractive();
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $archive,
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
        public function filterby($item,$id) {
            
            try {
                $archive = $this->ArchiveRepo->filterby($item,$id);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $archive,
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
        public function find($id) {
            
            try {
                $archive = $this->ArchiveRepo->find($id);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $archive,
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
                'name'    => 'required',
                'type'    => 'required',
                'creation_date'    => 'required',
                'size'    => 'required',
                'dimension'    => 'required',
                'url'    => 'required',
               // 'title'    => 'required',
                'legend'    => 'required',
               // 'alternative_text'    => 'required',
               // 'description'    => 'required',
                'id_user'    => 'required',
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
                    'name'    => $request->get('name'),
                    'type' => $request->get('type'),
                    'creation_date'    => $request->get('creation_date'),
                    'size'    => $request->get('size'),
                    'dimension'    => $request->get('dimension'),
                    'url' => $request->get('url'),
                    'title'    => $request->get('title'),
                    'legend'    => $request->get('legend'),
                    'alternative_text'    => $request->get('alternative_text'),
                    'description' => $request->get('description'),
                    'id_user'    => $request->get('id_user'),
                    'active' => 1,
                ];
        
                $archive     = $this->ArchiveRepo->store($data);
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('El archivo ha sido registrado  correctamente'),
                    'data'    => $archive,
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
        
        public function update(Request $request,$id) {
            
            Log::debug($request);
            $archive = $this->ArchiveRepo->find($id);

            
            if($request->has('name')){
                $data['name'] = $request->get('name');
            }
            if($request->has('type')){
                $data['type'] = $request->get('type');
            }
            if($request->has('creation_date')){
                $data['creation_date'] = $request->get('creation_date');
            }
            if($request->has('size')){
                $data['size'] = $request->get('size');
            }
            if($request->has('dimension')){
                $data['dimension'] = $request->get('dimension');
            }
            if($request->has('url')){
                $data['url'] = $request->get('url');
            }
            if($request->has('title')){
                $data['title'] = $request->get('title');
            }
            if($request->has('legend')){
                $data['legend'] = $request->get('legend');
            }
            if($request->has('alternative_text')){
                $data['alternative_text'] = $request->get('alternative_text');
            }
            if($request->has('description')){
                $data['description'] = $request->get('description');
            }
            if($request->has('id_user')){
                $data['id_user'] = $request->get('id_user');
            }

    
            try {
               
                $archive = $this->ArchiveRepo->update($archive, $data);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('El archivo ha sido modificado correctamente '),
                    'data'    => $archive,
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
                
                $archive = $this->ArchiveRepo->find($id);
                $archive = $this->ArchiveRepo->delete($archive, ['active' => 0]);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('El archivo ha sido eliminado correctamente'),
                    'data'    => $archive,
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
                'name.required'  => __('El nombre es requerido'),
                'type.required'      => __('El tipo es requerido'),
                'creation_date.required'  => __('La fecha de creacion es requerida'),
                'size.required'  => __('El tamaño es requerida'),
                'dimension.required'  => __('La dimension es requerida'),
                'url.required'      => __('La url es requerido'),
               // 'title.required'  => __('El titulo es requerido'),
                'legend.required'  => __('La leyenda es requerida'),
               // 'alternative_text.required'      => __('El texto alternativo es requerido'),
                //'description.required'  => __('La descripcion es requerida'),
                'id_user.required'  => __('El usuario es requerido'),

            ];
        }

    }
