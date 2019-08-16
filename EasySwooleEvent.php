<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2018/5/28
 * Time: 下午6:33
 */

namespace EasySwoole\EasySwoole;


use App\Exceptions\ExceptionHandler;
use EasySwoole\Component\Di;
use EasySwoole\Component\Pool\Exception\PoolObjectNumError;
use EasySwoole\EasySwoole\Swoole\EventRegister;
use EasySwoole\EasySwoole\AbstractInterface\Event;
use EasySwoole\Http\Request;
use EasySwoole\Http\Response;
use EasySwoole\Http\Message\Status;
use EasySwoole\MysqliPool\MysqlPoolException;
use EasySwoole\RedisPool\RedisPoolException;

class EasySwooleEvent implements Event
{

    public static function initialize()
    {
        // TODO: Implement initialize() method.
        date_default_timezone_set('Asia/Shanghai');
        Di::getInstance()->set(SysConst::HTTP_EXCEPTION_HANDLER,[ExceptionHandler::class,'handle']);

    }

    public static function mainServerCreate(EventRegister $register)
    {

        // TODO: Implement mainServerCreate() method.


        $mysqlConfig = new \EasySwoole\Mysqli\Config(Config::getInstance()->getConf('MYSQL'));
        try {
            \EasySwoole\MysqliPool\Mysql::getInstance()->register('mysql', $mysqlConfig);
        } catch (MysqlPoolException $e) {
            echo "[Warn] --> mysql池注册失败\n";
        }


        $configData = Config::getInstance()->getConf('REDIS');
        $config = new \EasySwoole\RedisPool\Config($configData);
// $config->setOptions(['serialize'=>true]);
        /**
        这里注册的名字叫redis，你可以注册多个，比如redis2,redis3
         */
        try {
            $poolConf = \EasySwoole\RedisPool\Redis::getInstance()->register('redis', $config);
            $poolConf->setMaxObjectNum($configData['maxObjectNum']);
            $poolConf->setMinObjectNum($configData['minObjectNum']);
        } catch (RedisPoolException $e) {
            echo "[Warn] --> Redis池注册失败\n";
        } catch (PoolObjectNumError $e) {
            echo "[Warn] --> Redis参数设置失败\n";
        }


    }

    public static function onRequest(Request $request, Response $response): bool
    {

        $allow_origin = array(
            '*',
//            'http://192.168.1.111',
        );

        $origin = $request->getHeader('origin');

        if ($origin !== []){
            $origin = $origin[0];
            if(in_array($origin, $allow_origin)){
                $response->withHeader('Access-Control-Allow-Origin', $origin);
                $response->withHeader('Access-Control-Allow-Methods', 'GET, POST, OPTIONS');
                $response->withHeader('Access-Control-Allow-Credentials', 'true');
                $response->withHeader('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With, token');
                if ($request->getMethod() === 'OPTIONS') {
                    $response->withStatus(Status::CODE_OK);
                    return false;
                }
            }
        }

        $response->withHeader('Content-type', 'application/json;charset=utf-8');

        return true;
    }

    public static function afterRequest(Request $request, Response $response): void
    {
        // TODO: Implement afterAction() method.
    }
}