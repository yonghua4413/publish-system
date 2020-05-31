<?php

namespace App\Http\Providers\Upload;

use Illuminate\Http\Request;
use Qcloud\Cos\Client;

class UploadProvider
{
    public function getConfig()
    {
        $config = json_decode(
            preg_replace(
                "/\/\*[\s\S]+?\*\//", "",
                file_get_contents(dirname(__FILE__) ."/upload_config.json")),
            true
        );
        return json_encode($config);
    }

    public function uploadImg()
    {
        $request = app(Request::class);
        $file_key = "upfile";
        if ($request->hasFile($file_key) && $request->file($file_key)->isValid()) {
            $file_path = $request->file($file_key)->path();
            $extension = $request->file($file_key)->extension();
            $mime_type = $request->file($file_key)->getClientMimeType();
            $file_size = $request->file($file_key)->getSize();

            if (!is_numeric(strpos($mime_type, 'image'))) {
                return json_encode(["state" => "格式不支持"]);
            }
            $full_path = sprintf(
                '/uploads/%s/%s/%s.%s',
                $mime_type,
                date('Ymd'),
                time() . last(explode('/', $file_path)),
                $extension
            );
            $this->uploadToCos($full_path, $file_path);

            return json_encode([
                "state" => "SUCCESS",
                "url" => $full_path,
                "title" => "",
                "original" => "",
                "type" => $extension,
                "size" => $file_size
            ]);
        }
        return json_encode([
            "state" => "上传失败"
        ]);
    }

    public function getCosClient()
    {
        return new Client([
            'region' => 'ap-shanghai', #地域，如ap-guangzhou,ap-beijing-1
            'credentials' => array(
                'secretId' => env('COS_ID'),
                'secretKey' => env('COS_KEY'),
            )]);
    }

    public function uploadToCos($cos_path, $local_path)
    {
        $client = $this->getCosClient();
        $bucket = env('COS_BUCKET');
        $client->putObject([
            'Bucket' => $bucket,
            'Key' => $cos_path,
            'Body' => fopen($local_path, 'rb')
        ]);
    }
}