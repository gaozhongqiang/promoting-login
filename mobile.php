<?php
namespace Promoting\Login;
/**
短信发送
 */
class Mobile{
    private static $codeType = array("find_password");
    private static $actionType	= array("add","edit","check");
    //接收验证码
    public static function get_check_code($_this){
        if(!IsAjax){
            return array(-1,"错误，请不要错误提交！");
        }
        $mobile = $_this->method_post_value("mobile");

        //手机格式检查
        if(!self::is_mobile_phone($mobile)){
            return array(-1,'手机号格式错误，请重新输入');
        }

        //返回当前公会长的信息
        $_this->getmodel("Promuser_model");
        $promuserData=$_this->Promuser_model->get_have_data(array("promuser_phone='{$mobile}'"));
        if(empty($promuserData)){
            return array(-1,"手机号不存在，请重新输入！");
        }
        if($promuserData['promuser_state'] == -1){
            return array(-1,"很抱歉，此账号已被封禁");
        }
        $_this->gethelper('aliyun');
        $mmv_sig = $_this->method_post_value("man_machine_verification_sig");
        $mmv_sessionid = $_this->method_post_value("man_machine_verification_sessionid");
        $mmv_token = $_this->method_post_value("man_machine_verification_token");
        $mmv_result = man_machine_verification($mmv_sessionid,$mmv_sig,$mmv_token);
        if($mmv_result!=100){
            //100表示验签通过，900表示验签失败,400表示参数错误,500表示系统内部错误
            return array(-1,"请进行人机验证！（拖动滑块到最右边）");
        }
        //取得手机验证码
        return array(0,$promuserData);
    }
    //检查验证码是否正确
    public static function check_phone_code($_this){
        if(!IsAjax){
            return array(-1,"错误，请不要错误提交！");
        }
        $mobile = $_this->method_post_value("phone");
        //手机格式检查
        if(!self::is_mobile_phone($mobile)){
            return array(-1,'手机号格式错误，请重新输入');
        }
        $phonecode=$_this->method_post_value("code");
        if(empty($phonecode)){
            return array(-1,"请输入验证码！");
        }
        $_this->getmodel("Promuser_model");
        $promuserData=$_this->Promuser_model->get_have_data(array("promuser_phone='{$mobile}'"));
        if(empty($promuserData)){
            return array(-1,"手机号不存在，请重新输入！");
        }
        if($promuserData['promuser_state'] == -1){
            return array(-1,"很抱歉，此账号已被封禁");
        }

        /*$cache_code_key = $mobile.'DefaultID';
        $cache_verify_code = GetAllDomainCache($cache_code_key);
        if(empty($cache_verify_code)){
            return array(-1,'验证码已过期，请重新获取！');
        }
        if($cache_verify_code != $code){
            return array(-1,'验证码不正确！');
        }
        DelAllDomainCache($cache_code_key);*/
        return array(0,FormTokenEncryption(array("phone"=>$mobile,"promuser_id"=>$promuserData["promuser_id"])));
    }
    public static function is_mobile_phone($phone){
        return preg_match("/^\d{1,4}\-\d{7,12}$/",$phone) || self::is_china_mobile_phone($phone);
    }
    /************************
     * 判断是否是中国的手机。
     * @param $phone
     * @return false|int
     *************************/
    public static function is_china_mobile_phone($phone){
        return preg_match("/^1\d{10}$/",preg_replace("/^(86)\-(\d+)$/","$2",ltrim($phone,"0")));
    }
}







