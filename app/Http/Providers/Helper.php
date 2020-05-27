<?php

namespace App\Http\Providers;

use App\Repository\Repository;
use App\Repository\UserPublishRepository;
use GuzzleHttp\Client;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class Helper
{

    /**
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function returnJson(array $data)
    {
        return response()->json([
            'status' => Arr::get($data, 0, 0),
            'data' => Arr::get($data, 1, []),
            'message' => Arr::get($data, 2, 'request is ok'),
        ]);
    }

    public function getCategory()
    {
        $redis_key = "category";
        $category = Redis::get($redis_key);
        if($category) {
            return json_decode($category, true);
        }
        $repository = app(Repository::class);
        $repository->limit = 10;
        $category = $repository->getList("category", [], ['*']);
        foreach ($category as $key => $item){
            $category[$key] = (array)$item;
        }
        Redis::setex($redis_key, env('REDIS_LIFETIME'), json_encode($category));
        return $category;
    }

    public function getBlogroll()
    {
        $redis_key = "blogroll";
        $blogroll = Redis::get($redis_key);
        if($blogroll) {
            return json_decode($blogroll, true);
        }
        $repository = app(Repository::class);
        $repository->limit = 10;
        $blogroll = $repository->getList("blogroll", [], ['*']);
        foreach ($blogroll as $key => $item){
            $blogroll[$key] = (array)$item;
        }
        Redis::setex($redis_key, env('REDIS_LIFETIME'), json_encode($blogroll));
        return $blogroll;
    }

    public function checkCaptcha($ticket, $randStr)
    {
        $url = env('CAPTCHA_API_URL');
        $arr = [
            'aid' => env('CAPTCHA_APP_ID'),
            'AppSecretKey' => env('CAPTCHA_APP_SECRET'),
            'Ticket' => $ticket,
            'Randstr' => $randStr,
            'UserIP' => request()->ip()
        ];
        $url .= '?' . http_build_query($arr);

        $client = new Client();
        $response = $client->get($url)->getBody()->getContents();
        if (empty($response)) {
            return [1, [], '第三方服务器异常'];
        }
        $response = json_decode($response, true);
        if ($response['response'] != 1) {
            return [1, [], '非法请求'];
        }
        return null;
    }

    public function verifyEmail($email)
    {
        $pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/";
        return preg_match($pattern, $email);
    }

    public function getHotUser($limit = 10)
    {
        $redis_key = "host_user";
        $users = Redis::get($redis_key);
        if($users) {
            return json_decode($users, true);
        }
        $users = app(UserPublishRepository::class)->getHotUser($limit);
        if($users) {
            Redis::setex($redis_key, 30, json_encode($users));
            return $users;
        }
        return null;
    }
}