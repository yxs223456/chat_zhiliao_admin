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
}
