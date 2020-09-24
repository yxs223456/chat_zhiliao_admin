<?php
/**
 * Created by PhpStorm.
 * User: yangxs
 * Date: 2018/9/18
 * Time: 17:44
 */
namespace app\common;

class AppException extends \Exception
{
    const COM_PARAMS_ERR = [1, "请求参数错误"];
    const COM_FILE_ERR = [2, "上传文件不存在或超过服务器限制"];
    const COM_DATE_ERR = [3, "日期格式错误"];
    const COM_MOBILE_ERR = [4, "手机号格式错误"];
    const COM_ADDRESS_ERR = [5, "地址信息不全"];
    const COM_INVALID = [6, "非法请求"];

    const ADMIN_USERNAME_EXISTS_ALREADY = [1000, "账号已存在"];

    public static function factory($errConst)
    {
        $e = new self($errConst[1], $errConst[0]);
        throw $e;
    }
}