<?php
    
    namespace App\Http\Controllers\Api;
    
    
    use App\Http\Models\Repositories\PageRepo;
    use App\Http\Models\Repositories\ArchiveRepo;
    use Illuminate\Http\Request;
    use Illuminate\Routing\Controller as BaseController;
    use Illuminate\Support\Facades\Validator;
    use Illuminate\Support\Facades\Log;
    
    class PageController extends BaseController {
        
        private $PageRepo;
        private $ArchiveRepo;
        
        public function __construct(PageRepo $PageRepo, ArchiveRepo $ArchiveRepo) {
            
            $this->PageRepo = $PageRepo;
            $this->ArchiveRepo        = $ArchiveRepo;
        }
        
        public function index() {
            
            try {
                $page = $this->PageRepo->all();
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $page,
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
                $page = $this->PageRepo->filteractive();
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $page,
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
                $page = $this->PageRepo->find($id);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $page,
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
                'title' => 'required',
                'content' => 'required',
                'id_featured_image' => 'required',
                'visibility' => 'required',
                'status_page' => 'required',
                'id_user' => 'required',
                'permanent_link' => 'required',
                'creation_date' => 'required',
                'publication_date' => 'required',
                'modification_date' => 'required',
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
                   'title' => $request->get('title'),
                    'content' => $request->get('content'),
                    'id_featured_image' => $request->get('id_featured_image'),
                    'visibility' => $request->get('visibility'),
                    'status_page' => $request->get('status_page'),
                    'id_user' => $request->get('id_user'),
                    'permanent_link' => $request->get('permanent_link'),
                    'creation_date' => $request->get('creation_date'),
                    'publication_date' => $request->get('publication_date'),
                    'modification_date' => $request->get('modification_date'),
                    'active'     => 1,
                ];
                
                $page = $this->PageRepo->store($data);
                $response       = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('La pagina ha sido registrado correctamente'),
                    'data'    => $page,
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
        
        public function update(Request $request, $id) {
            
            Log::debug($request);
            $page = $this->PageRepo->find($id);
            
            
            if ($request->has('title')) {
                $data['title'] = $request->get('title');
            }
            if ($request->has('content')) {
                $data['content'] = $request->get('content');
            }
            if ($request->has('id_featured_image')) {
                $data['id_featured_image'] = $request->get('id_featured_image');
            }
            if ($request->has('visibility')) {
                $data['visibility'] = $request->get('visibility');
            }
            if ($request->has('status_page')) {
                $data['status_page'] = $request->get('status_page');
            }
            if ($request->has('id_user')) {
                $data['id_user'] = $request->get('id_user');
            }
            if ($request->has('permanent_link')) {
                $data['permanent_link'] = $request->get('permanent_link');
            }
            if ($request->has('creation_date')) {
                $data['creation_date'] = $request->get('creation_date');
            }
            if ($request->has('publication_date')) {
                $data['publication_date'] = $request->get('publication_date');
            }
            if ($request->has('modification_date')) {
                $data['modification_date'] = $request->get('modification_date');
            }
            if ($request->has('active')) {
                $data['active'] = $request->get('active');
            }
            
            try {
                
                $page = $this->PageRepo->update($page , $data);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('El Page ha sido modificado correctamente '),
                    'data'    => $page,
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
                
                $page = $this->PageRepo->find($id);
                $page = $this->PageRepo->delete($page, ['active' => 0]);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('El Page ha sido eliminado correctamente '),
                    'data'    => $page,
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
                'title.required' => __('El titulo es requerido'),
                'content.required' => __('El contenido es requerido'),
                'id_featured_image.required' => __('La imagen destacada es requerida'),
                'visibility.required' => __('La visibilidad es requerida'),
                'status_page.required' => __('El estatus de la pagina es requerido'),
                'id_user.required' => __('El usuario es requerido'),
                'permanent_link.required' => __('El link permanente es requerido'),
                'creation_date.required' => __('La fecha de creacion es requerida'),
                'publication_date.required' => __('La fecha de publicacion es requerida'),
                'modification_date.required' => __('La fecha de modificacion es requerida'),
            ];
        }
        
    }
