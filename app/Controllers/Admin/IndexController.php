<?php
/**
 * Created by PhpStorm.
 * User: lsw
 * Date: 18-5-15
 * Time: 上午9:20
 */

namespace Ddb\Controllers\Admin;


use Ddb\Core\ViewBaseController;

/**
 * Class IndexController
 * 后台
 * @RoutePrefix("/admin/index")
 */
class IndexController extends ViewBaseController
{
    /**
     * @Get("/")
     */
    public function indexAction(){
        $this->view->setVars([
            "aaa"=>"asasasdad",
            "bbb"=>"bbb",
        ]);
    }

}