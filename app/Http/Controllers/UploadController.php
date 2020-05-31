<?php

namespace App\Http\Controllers;

use App\Http\Providers\Upload\UploadProvider;

class UploadController extends Controller
{
    public function method(UploadProvider $provider)
    {
        $action = $this->request->get("action", '');
        switch ($action) {
            case "config" :
                $result = $provider->getConfig();
                break;
            case "uploadimage":
                $result = $provider->uploadImg();
                break;
            default:
                $result = ['state' => '请求被拒绝！'];
        }

        $callback = $this->request->get('callback', "");
        if ($callback) {
            if (preg_match("/^[\w_]+$/", $callback)) {
                return htmlspecialchars($callback) . '(' . $result . ')';
            }
            return json_encode(array(
                'state'=> 'callback参数不合法'
            ));
        }
        return $result;
    }
}