<?php
/**
 * Created by PhpStorm.
 * User: lsw
 * Date: 18-5-15
 * Time: 上午9:20
 */

namespace Ddb\Controllers\Admin\Business;

use Ddb\Controllers\AdminAuthController;
use Ddb\Models\RepairImages;
use Ddb\Modules\Member;
use Ddb\Modules\MemberPoint;
use Ddb\Modules\Repair;

/**
 * Class RepairController
 * 维修点
 * @RoutePrefix("/admin/business/repair")
 */
class RepairController extends AdminAuthController
{
    /**
     * @Get("/{id:[0-9+]}")
     */
    public function indexAction($id)
    {

    }

    /**
     * @Put("/{id:[0-9+]}")
     */
    public function editAction($id)
    {

    }

    /**
     * @Delete("/{id:[0-9+]}")
     */
    public function delAction($id)
    {

    }

    /**
     * @Get("/list")
     */
    public function listAction()
    {
        $request = $this->request->get();
        $request['limit'] = $this->limit;
        $request['page'] = $this->page;
        set_default_values($request, ['belonger_name', 'mobile', 'province', 'city', 'district']);
        $request['status'] = isset($request['status']) ? $request['status'] : 99;
        $request['type'] = isset($request['type']) ? $request['type'] : 99;
        $data = service("repair/query")->getList($request);
        $this->view->setVars([
            'page' => $this->page,
            'data' => $data->items->toArray(),
            'total' => $data->total_items,
            'search' => $request
        ]);
    }

    /**
     * @Get("/to_auth")
     */
    public function toAuthAction()
    {
        $request = $this->request->get();
        $request['limit'] = $this->limit;
        $request['page'] = $this->page;
        set_default_values($request, ['belonger_name', 'mobile', 'province', 'city', 'district']);
        $request['status'] = isset($request['status']) ? $request['status'] : 99;
        $request['type'] = isset($request['type']) ? $request['type'] : 99;
        $request['status'] = Repair::STATUS_CREATE;
        $data = service("repair/query")->getList($request);
        $this->view->setVars([
            'page' => $this->page,
            'data' => $data->items->toArray(),
            'total' => $data->total_items,
            'search' => $request
        ]);
    }

    /**
     * @Get("/{id:[0-9]+}/imgs")
     */
    public function imgsAction($repairId)
    {
        $repairImages = RepairImages::findByRepairId($repairId);
        if (count($repairImages->toArray()) == 0) {
            return $this->error('暂无照片');
        }
        $ids = array_column($repairImages->toArray(), 'id');
        $data = [];
        foreach ($ids as $id) {
            $data[] = "/wechat/repair/repairImg/" . $id;
        }
        return $this->success($data);
    }

    /**
     * @Post("/auth")
     * 审核
     */
    public function authAction()
    {
        $request = $this->data;
        if ($repair = Repair::findFirst($request['repair_id'])) {
            if ($request['type'] == 'pass') {
                $status = Repair::STATUS_PASS;
                $message = '维修点审核通过';
            } else {
                $status = Repair::STATUS_REFUSE;
                $message = '维修点审核拒绝,原因：' . $request['reason'];
            }
            $this->db->begin();
            if (!service('member/manager')->saveMessage($repair->getCreateBy(), $message)) {
                $this->db->rollback();
                return $this->error('消息未发送成功');
            }
            if (!$repair->setStatus($status)->save()) {
                $this->db->rollback();
                return $this->error('状态变更失败');
            }
            if ($request['type'] == 'pass') {
                $member = Member::findFirst($repair->getCreateBy());
                if (!service("point/manager")->create($member, MemberPoint::TYPE_ADD_REPAIRS)) {
                    $this->db->rollback();
                    return $this->error("积分变更失败");
                }
            }
            $this->db->commit();
            return $this->success();
        }
        return $this->error();
    }

    /**
     * @Post("")
     * 修改维修点的信息
     */
    public function updateAction()
    {
        $request = $this->request->get();
        if ($repair = Repair::findFirst($request['repair_id'])) {
            if ($repair->setName($request['name'])->setMobile($request['mobile'])->save()) {
                return $this->success();
            }
        }
        return $this->error("没有此维修点数据");
    }

}