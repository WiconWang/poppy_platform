<?php
/**
 * 557 输出.
 * @author WiconWang <WiconWang@gmail.com>
 * @copyright  2018/10/19 1:46 PM
 */

namespace App\Utilities;

use App\Config\ReturnCode;
use EasySwoole\Http\Response;


trait ResponseHelper
{

//
//    private $response;
//
//    protected function response(): Response
//    {
//        return $this->response;
//    }


//    // 用返回名，查返回码
//    public function ReturnCode($returnName)
//    {
//        $ReturnCodes = array_flip(config('ReturnCode'));
//        if (isset($ReturnCodes[$returnName])) {
//            return $ReturnCodes[$returnName];
//        } else {
//            return $ReturnCodes['ERROR'];
//        }
//    }
//
//    // 用返回名，查返回语句
//    public function returnInfo($returnName)
//    {
//        return trans('ReturnCode.' . $returnName);
//    }
//
//    // 用返回码，查返回语句
//    public function returnInfoByCode($ReturnCode)
//    {
//        $returnName = config('ReturnCode.' . $ReturnCode);
//        return $this->returnInfo($returnName);
//    }
//
//
//    /**
//     * 转换列表为标准输出
//     * @param int $total
//     * @param array $data
//     * @return array
//     */
//    protected function formatList($total = 0, $data = [])
//    {
//        return [
//            'total' => $total,
//            'list' => $data,
//        ];
//    }

    /**
     * 转换标准输出
     *
     * @param $ReturnCode
     * @param string $msg
     * @param array $data
     * @return array
     */
//    protected function getStandardResult($ReturnCode, $msg = "", $data = [])
//    {
//        return [
//            'code'    => $ReturnCode,
//            'message' => empty($msg) ? ReturnCode::getMessage($ReturnCode) : $msg,
//            'data'    => $data,
//        ];
//    }


    /**
     * 标准 JSON 输出
     *
     * @param $bool
     */
    public function responseDefaultJson($bool)
    {
        $ReturnCode = $bool ? ReturnCode::SUCCESS : ReturnCode::ERROR;
        $this->writeJson($ReturnCode,[], ReturnCode::getMessage($ReturnCode));
    }


    /**
     * 标准 JSON 输出
     *
     * @param $ReturnCode
     * @param string $msg
     * @param array $data
     * @return bool
     */
    public function responseJson($ReturnCode, $msg = '', $data = [])
    {
        $this->writeJson($ReturnCode,$data, empty($msg) ? ReturnCode::getMessage($ReturnCode) : $msg);
    }


    /**
     * 标准 JSONP 输出
     *
     * @param $returnName
     * @param string $msg
     * @param array $data
     * @param string $callback
     */
//    public function responseJsonP($returnName, $msg = '', $data = [], $callback = 'callback')
//    {
//        header('Content-type:text/json');
//        echo response()->jsonp(
//            $callback,
//            $this->getStandardResult($returnName, $msg, $data),
//            200
//        )->content();
//        exit;
//    }



    /**
     * 定义一个内部通行的结果数组，应对复杂情况
     * 状态为1正常。0为故障
     * @param int $status
     * @param string $msg
     * @param array $data
     * @return array
    */
//    public function returnArray($status = 1, $msg = '', $data = [])
//    {
//        return array($status, $msg, $data);
//    }
//
//
//    /**
//     * 把 NULL 转换成空值，以防 SQL 出错
//     * @param $data
//     * @return mixed
//     */
//    public function transNullToEmpty($data)
//    {
//        foreach ($data as $k => $v) {
//            if ($v === null) {
//                $data[$k] = '';
//            }
//        }
//
//        return $data;
//
//    }
}
