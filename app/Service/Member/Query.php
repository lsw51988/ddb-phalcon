<?php
/**
 * Created by PhpStorm.
 * User: lsw
 * Date: 18-4-24
 * Time: 下午11:20
 */

namespace Ddb\Service\Member;


use Ddb\Models\MemberBikeImages;
use Ddb\Models\MemberPoints;
use Ddb\Models\Members;
use Ddb\Modules\MemberBike;
use Ddb\Modules\Repair;
use Ddb\Service\BaseService;
use Ddb\Models\Areas;

class Query extends BaseService
{
    /**
     * @param $point
     * @return string
     * 根据总积分,包括已经消耗的
     */
    public function getLevel($point)
    {
        switch ($point) {
            case $point <= 500:
                return "铜牌会员";
                break;
            case $point <= 1000 && $point > 500:
                return "银牌会员";
                break;
            case $point <= 2000 && $point > 1000:
                return "金牌会员";
                break;
            case $point <= 5000 && $point > 2000:
                return "钻石会员";
                break;
            case $point > 5000:
                return "至尊宝";
                break;
        }
    }

    /**
     * 获取用户获取的总积分
     */
    public function getTotalPoints(Members $member)
    {
        $totalPoints = MemberPoints::sum([
            "column" => "value",
            "conditions" => "member_id = :member_id: AND type>0",
            "bind" => [
                "member_id" => $member->getId()
            ]
        ]);
        return is_null($totalPoints) ? 0 : $totalPoints;
    }

    /**
     * 获取用户的详细信息
     */
    public function getAuthInfo($member)
    {
        $data = [];
        $data['real_name'] = $member->getRealName();
        $data['mobile'] = $member->getMobile();
        if ($memberBike = MemberBike::findFirstByMemberId($member->getId())) {
            $data['brand_name'] = $memberBike->getBrandName();
            $data['buy_date'] = $memberBike->getBuyDate();
            $data['number'] = $memberBike->getNumber();
            $data['voltage'] = $memberBike->getVoltage();
            $data['price'] = $memberBike->getPrice();
            $data['status'] = $memberBike->getStatus();
            $data['last_change_time'] = $memberBike->getLastChangeTime();
            $memberBikeImgs = MemberBikeImages::find([
                "columns" => "id",
                "conditions" => "member_bike_id = :member_bike_id:",
                "bind" => [
                    "member_bike_id" => $memberBike->getId()
                ]
            ])->toArray();
            if (count($memberBikeImgs) > 0) {
                $imgs = array_column($memberBikeImgs, "id");
                foreach ($imgs as $k => $v) {
                    $imgs[$k] = di("config")->app->URL . "/wechat/member/bikeImg/" . $v;
                }
                $data['bikeImgs'] = $imgs;
            } else {
                $data['bikeImgs'] = [];
            }
        } else {
            $data['brand_name'] = "";
            $data['buy_date'] = "";
            $data['number'] = "";
            $data['voltage'] = "";
            $data['price'] = "";
            $data['status'] = "";
            $data['last_change_time'] = "";
            $data['bikeImgs'] = [];
        }
        $districtCode = $member->getDistrict();
        if ($addr = Areas::findFirstByDistrictCode($districtCode)) {
            $data['region'] = [$addr->getProvinceName(), $addr->getCityName(), $addr->getDistrictName()];
        }
        return $data;
    }

    /**
     * 判断用户是否是修理者
     */
    public function isRepair($member){
        if(Repair::findFirstByBelongerId($member->getId())){
            return true;
        }
        return false;
    }
}