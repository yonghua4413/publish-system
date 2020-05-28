<?php

namespace App\Http\Controllers;

use App\Http\Providers\Helper;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $data = [
        'page' => 1,
        'pageSize' => 10,
        'totalPage' => 1,
        'totalRow' => 0,
        "seo" => [
            "title" => "",
            "keywords" => "",
            "description" => ""
        ]
    ];

    public $request;

    public $helper;

    public function __construct(Request $request, Helper $helper)
    {
        $this->request = $request;

        $this->helper = $helper;
    }
}
