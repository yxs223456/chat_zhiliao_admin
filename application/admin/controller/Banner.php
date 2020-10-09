<?php
/**
 * Created by PhpStorm.
 * User: yangxiushan
 * Date: 2020-09-24
 * Time: 15:25
 */
namespace app\admin\controller;

use app\common\enum\BannerPositionEnum;
use app\common\enum\IsShowEnum;
use app\common\model\BannerModel;

class Banner extends Common
{
    public function index()
    {
        $bannerModel = new BannerModel();
        $requestMap = $this->convertRequestToMap();
        $list = $bannerModel->paginateList($requestMap);

        foreach ($list as $item) {
            $item["position_desc"] = BannerPositionEnum::getEnumDescByValue($item["position"]);
        }
        $this->assign("list", $list);

        $bannerIsShowEnum = IsShowEnum::getAllList();
        $this->assign("bannerIsShowEnum", $bannerIsShowEnum);

        return $this->fetch("list");
    }

    public function add()
    {
        $allPosition = BannerPositionEnum::getAllList();
        $this->assign("allPosition",$allPosition);

        return $this->fetch();
    }

    public function addPost()
    {
        $name = input('name', '');
        $imageUrl = input('image_url', '');
        $isShow = input("is_show", 0);
        $sort = (int) input("sort", 0);
        $position = (int) input("position",1);

        $bannerModel = new BannerModel();
        $bannerModel->saveByData([
            "name" => $name,
            "image_url" => $imageUrl,
            "is_show" => $isShow,
            "sort" => $sort,
            "position" => $position
        ]);


        $this->success("添加成功",url("index"));
    }
}
