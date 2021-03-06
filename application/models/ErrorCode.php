<?php
class ErrorCodeModel{

    public $system_errors = null;

    function __construct()
    {
        $this->system_errors = $this->system_errors();
    }

    public function system_errors()
    {

        return array(
            10001 => '系统错误',
            10002 => '数据库错误',
            10003 => 'API不存在',
            10004 => '签名错误',
            10005 => '缺少参数(%s)',
            10006 => '参数错误',
            10007 => '数据错误',
            10008 => 'token失效，请重新登录',
            10009 => '请求参数缺失',
            10010 => '请求key解析失败',
            10011 => '请求参数解析失败',
            10012 => '请求参数不能为空',

        );
    }
}