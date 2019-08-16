<?php
/**
 * 557 easy.
 * @author WiconWang <WiconWang@gmail.com>
 * @copyright  2019/8/15 1:36 PM
 *
 * DOCS: https://github.com/nikic/FastRoute/
 */

namespace App\HttpController;

use App\Config\ReturnCode;
//use App\Utilities\ResponseHelper;
use EasySwoole\Http\AbstractInterface\AbstractRouter;
use FastRoute\RouteCollector;
use EasySwoole\Http\Request;
use EasySwoole\Http\Response;


class Router extends AbstractRouter
{
//    use ResponseHelper;


    function initialize(RouteCollector $r)
    {
        // 是否启用默认路由
        $this->setGlobalMode(false);

        // 拦截无方法时异常
        // 可使用 Request $request,Response $response
        $this->setMethodNotAllowCallBack(function () {
            throw new \RuntimeException('未找到处理方法', ReturnCode::NOT_FOUND);
        });

        // 拦截无路由时异常
        // 可使用 Request $request,Response $response
        $this->setRouterNotFoundCallBack(function () {
            throw new \RuntimeException('未找到路由匹配', ReturnCode::NOT_FOUND);
        });

        // 定义路由区域
//        $r->get('/user','/Admin/Article/getAll');
//        $r->get('/user/{id:\d+}', function (Request $request, Response $response) {
////            $this->responseJson(ReturnCodeName::ERROR);
//            $response->write("this is router user ,your id is {$request->getQueryParam('id')}");//获取到路由匹配的id
//            return false;//不再往下请求,结束此次响应
//        });
        $r->addGroup('/admin/v1', function (RouteCollector $r) {
//            $r->addRoute('GET', '/admins', 'getAll');
            $r->addGroup('/admins', function (RouteCollector $r) {
                $r->get('/info', '/Admin/Admin/getAll');
                $r->get('/info/{id:\d+}', '/Admin/Admin/getOne');
                $r->post('/info', '/Admin/Admin/add');
                $r->put('/info/{id:\d+}', '/Admin/Admin/update');
                $r->delete('/info/{id:\d+}', '/Admin/Admin/delete');
            });

            $r->addGroup('/members', function (RouteCollector $r) {
                $r->get('/info', '/Admin/Member/getAll');
                $r->get('/info/{id:\d+}', '/Admin/Member/getOne');
                $r->post('/info', '/Admin/Member/add');
                $r->put('/info/{id:\d+}', '/Admin/Member/update');
                $r->delete('/info/{id:\d+}', '/Admin/Member/delete');
            });

//            $r->get('/info/{id:\d+}', function (Request $request, Response $response) {
//                $response->write("this is info info ,your id is {$request->getQueryParam('id')}");//获取到路由匹配的id
//                return false;//不再往下请求,结束此次响应
//            });
            $r->addRoute('GET', '/do-something', 'handler');
            $r->addRoute('GET', '/do-another-thing', 'handler');
            $r->addRoute('GET', '/do-something-else', 'handler');
        });
    }
}