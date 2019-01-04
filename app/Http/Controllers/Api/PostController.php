<?php
    
    namespace App\Http\Controllers\Api;
    
    
    use App\Http\Models\Repositories\PostRepo;
    use App\Http\Models\Repositories\ArchiveRepo;
    use App\Http\Models\Repositories\UserRepo;
    use Illuminate\Http\Request;
    use Illuminate\Routing\Controller as BaseController;
    use Illuminate\Support\Facades\Validator;
    use Illuminate\Support\Facades\Log;
    
    class PostController extends BaseController {
        
        private $PostRepo;
        private $ArchiveRepo;
        private $UserRepo;
        
        public function __construct(PostRepo $PostRepo, ArchiveRepo $ArchiveRepo, UserRepo $UserRepo) {
            
            $this->PostRepo = $PostRepo;
            $this->ArchiveRepo        = $ArchiveRepo;
            $this->UserRepo = $UserRepo;
        }
        
        public function index() {
            
            try {
                $post = $this->PostRepo->all();
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $post,
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
                $post = $this->PostRepo->filteractive();
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $post,
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
                $post = $this->PostRepo->find($id);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('Datos Obtenidos Correctamente'),
                    'data'    => $post,
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
               // 'content' => 'required',
               // 'id_featured_image' => 'required',
                'visibility' => 'required',
                'status_post' => 'required',
                'id_user' => 'required',
                'permanent_link' => 'required',
                'creation_date' => 'required',
               // 'publication_date' => 'required',
               // 'modification_date' => 'required',
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
                    'status_post' => $request->get('status_post'),
                    'id_user' => $request->get('id_user'),
                    'permanent_link' => $request->get('permanent_link'),
                    'creation_date' => $request->get('creation_date'),
                    'publication_date' => $request->get('publication_date'),
                    'modification_date' => $request->get('modification_date'),
                    'active'     => 1,
                ];
                
                $post = $this->PostRepo->store($data);
                $response       = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('El post ha sido registrado correctamente'),
                    'data'    => $post,
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
            $post = $this->PostRepo->find($id);
            
            
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
            if ($request->has('status_post')) {
                $data['status_post'] = $request->get('status_post');
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
                
                $post = $this->PostRepo->update($post , $data);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('El post ha sido modificado correctamente '),
                    'data'    => $post,
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
                
                $post = $this->PostRepo->find($id);
                $post = $this->PostRepo->delete($post, ['active' => 0]);
                
                $response = [
                    'status'  => 'OK',
                    'code'    => 200,
                    'message' => __('El post ha sido eliminado correctamente '),
                    'data'    => $post,
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
               // 'content.required' => __('El contenido es requerido'),
               // 'id_featured_image.required' => __('La imagen destacada es requerida'),
                'visibility.required' => __('La visibilidad es requerida'),
                'status_post.required' => __('El estatus del post es requerido'),
                'id_user.required' => __('El usuario es requerido'),
                'permanent_link.required' => __('El link permanente es requerido'),
                'creation_date.required' => __('La fecha de creacion es requerida'),
             //   'publication_date.required' => __('La fecha de publicacion es requerida'),
               // 'modification_date.required' => __('La fecha de modificacion es requerida'),
            ];
        }
        
    }
