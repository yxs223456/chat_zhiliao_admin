<?php

//缓存用户信息
function cacheUserInfoByToken(array $userInfo, Redis $redis, $oldToken = "") {
    $key = "de_education:userInfoByToken:" . $userInfo["token"];
    $redis->hMSet($key, $userInfo);
    //缓存有效期72小时
    $redis->expire($key, 259200);

    if ($oldToken != "") {
        $oldKey = "de_education:userInfoByToken:" . $oldToken;
        $redis->del($oldKey);
    }
}

//通过token获取用户信息
function getUserInfoByToken($token, Redis $redis) {
    if ($token == "") {
        return [];
    }
    $key = "de_education:userInfoByToken:$token";
    return $redis->hGetAll($key);
}
