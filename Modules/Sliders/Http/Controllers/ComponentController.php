<?php

namespace Modules\Sliders\Http\Controllers;

use App\Components\Helper;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Facades\Image;

class ComponentController extends BaseController
{

    public static function Mime($mime)
    {

//        TODO https://svn.apache.org/repos/asf/httpd/httpd/trunk/docs/conf/mime.types
        $arrayImage = [
            'image/bmp',//TODO bmp
            'image/cgm', //TODO cgm
            'image/jpeg', //TODO jpeg jpg jpe
            'image/png', //TODO png
            'image/webp',
        ];
        $arrayAudio = [
            'audio/mpeg', //TODO mpga mp2 mp2a mp3 m2a m3a
            'video/ogg', //TODO oga ogg spx
            'audio/mp4', //TODO m4a mp4a
        ];
        $arrayVideo = [
            'video/mp4', //TODO mp4 mp4v mpg4
            'video/mpeg', //TODO mpeg mpg mpe m1v m2v
            'video/3gpp', //TODO 3gp
            'video/3gpp2', //TODO 3g2
            'video/x-flv', //TODO flv
            'video/x-ms-wmv', //TODO wmv
            'video/x-msvideo', //TODO avi
        ];
        $arrayOffice = [
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document', //TODO DOCX
            'application/vnd.openxmlformats-officedocument.presentationml.presentation',//TODO POINT
            'application/octet-stream',//TODO XLSX
            'application/pdf', //TODO PDF
        ];

        $code = 200;
        $type = '';
        if (in_array($mime, $arrayOffice, true)) {
            $type = 'office';
        } else if (in_array($mime, $arrayVideo, true)) {
            $type = 'video';
        } else if (in_array($mime, $arrayAudio, true)) {
            $type = 'audio';
        } else if (in_array($mime, $arrayImage, true)) {
            $type = 'image';
        } else {
            $code = 400;
        }

        $response = [
            'code' => $code,
            'type' => $type,
        ];

        return $response;


    }

    public static function uploadFile($request, $type)
    {

        $data = [
            'name' => null,
            'url' => '',
            'size' => '',
            'dimension' => '',
        ];

        $file = $request->file('file');
        if (is_file($file)) {

            $extension = $file->getClientOriginalExtension();
            $name = Helper::hashid(strtotime(date('Y-m-d H:i:s')), 10) . "." . $extension;

            \Storage::put('/records/' . $type . '/' . $name, \File::get($file));

            $pathTemp = 'upload/records/' . $type . '/' . $name;
            $path = asset($pathTemp);
            $dimension = is_null(getimagesize($path)[0]) ? '- - -' : getimagesize($path)[0] . 'x' . getimagesize($path)[1];

            $data['name'] = $name;
            $data['url'] = $path;
            $data['size'] = filesize(public_path($pathTemp));
            $data['dimension'] = $dimension;

        }

        return $data;


    }

    public static function uploadFile_sliders($request, $type, $id)
    {

        $data = [
            'name' => null,
            'url' => '',
        ];

        $file = $request->file('file');
        if (is_file($file)) {

            $id = $id + 1;
            //Get Extension of file
            $extension = $file->getClientOriginalExtension();
            //Generate Unique Name with HASH
            $name =  rand(). $id . "." . $extension;
//            $name = Helper::hashid(strtotime(date('H:i:s')), 10) ."." . $extension;
            //Define location of path to save Image
            $location = '/' . $type . '/' . $name;
            //Saving the image on Public Folder
            $path_save = \Storage::disk('public')->put($location, \File::get($file));
            //Get the path of image saved
            $path = env('URL_DOMAIN') . '/upload' . $location;
            $pathDB = '/upload' . $location;
            Log::debug('File Name:' . $name . '- Extension: ' . $extension . '- Type: ' . $type . '- path: ' . $path);

            $data['name'] = $name;
            $data['url'] = $pathDB;


        }

        return $data;


    }

    public static function uploadFile_Img($request, $width = 1263, $height = 564)
    {

        $data = [
            'name' => null,
            'url' => '',
        ];

        $file = $request->file('file');
        if (is_file($file)) {

            \Storage::makeDirectory('/sliders/');

            $name = Helper::hashid(strtotime(date('Y-m-d H:i:s')), 10) . ".png";
            Image::make($file)->resize($width, $height)->save("upload/sliders/" . $name, 30);

            $pathTemp = 'upload/sliders/' . $name;
            $path = asset($pathTemp);

            $data['name'] = $name;
            $data['url'] = $path;

        }

        return $data;


    }

    public static function deleteFile($url)
    {

        $delete = File::delete($url);

        return $delete;
    }

}
