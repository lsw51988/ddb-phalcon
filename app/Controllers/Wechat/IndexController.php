<?php
/**
 * Created by PhpStorm.
 * User: 阿德
 * Date: 2018/4/15
 * Time: 17:40
 */

namespace Ddb\Controllers\Wechat;

use Ddb\Core\BaseController;
use Ddb\Helper\Captcha;
use Ddb\Models\Areas;
use Ddb\Models\Members;

/**
 * Class IndexController
 * @package Ddb\Controllers\Wechat
 * @RoutePrefix("/wechat")
 */

class IndexController extends BaseController
{
    /**
     * @Post("/index")
     * 用户首次进入逻辑
     * 1.没有该用户，注册
     * 2.返回该用户信息
     */
    public function indexAction()
    {
        $data = $this->data;
        $openId = service("Member/Manager")->getOpenId($data['js_code']);
        $location = service("Member/Manager")->getLocation($data['latitude'], $data['longitude']);
        if (!$member = Members::findFirstByOpenId($openId)) {
            $data['open_id'] = $openId;
            //1.根据经纬度获取用户的当前地址
            if ($location->status!=0) {
                return $this->success($location);
                $data['province'] = "未知";
                $data['city'] = "未知";
                $data['district'] = "未知";
            } else {
                $area = Areas::findFirstByDistrictName($location->result->address_component->district);
                $data['province'] = $area->getProvinceCode();
                $data['city'] = $area->getCityCode();
                $data['district'] = $area->getDistrictCode();
            }

            $member = new Members();
            $data['token'] = md5($data['nickName'] . time() . rand(0, 9999));
            $data['token_time'] = date("Y-m-d H:i:s", strtotime("+1 month"));

            if (!$member->save($data)) {
                return $this->error("用户数据保存错误");
            }

            di("cache")->save($data['token'], serialize($member), 30 * 24 * 3600);
        } else {
            if (!di("cache")->get($member->getToken())) {
                $token = md5($data['nickName'] . time() . rand(0, 9999));
                $member->setToken($token)
                    ->setTokenTime(date("Y-m-d H:i:s", strtotime("+1 month")))
                    ->save();
                di("cache")->save($token, serialize($member), 30 * 24 * 60);
            }
        }
        if($location->status==0){
            service("Member/Manager")->saveLocation($member,$location);
            return $this->success([
                "token"=>$member->getToken(),
                "avatarUrl"=>$member->getAvatarUrl(),
                "nickName"=>$member->getNickName(),
                "auth_time"=>$member->getAuthTime()
            ]);
        }else{
            return $this->success($location);
        }
    }

    /**
     * @Get("/qr_code")
     * 获取公众号二维码
     */
    public function qr_codeAction(){
        ob_clean();
        header("Content-type:image/jpeg");
        echo file_get_contents(APP_PATH.'/../public/img/qr_code.jpg',true);
    }

    /**
     * @Get("/capture")
     * 获取验证码
     */
    public function captureAction(){
        $token = $this->data->token;
        $key = $token . 'captcha';
        $_vc = new Captcha();
        $_vc->doimg();
        di("cache")->save($key,$_vc->getCode(),300);
    }

}