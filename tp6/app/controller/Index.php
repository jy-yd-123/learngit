<?php
namespace app\controller;

use app\BaseController;

class Index extends BaseController
{
    public function index()
    {
       
          $header = array(
                array('name' => '姓名'),
                array('name' => '年龄'),
                array('name' => '身份'),
                array('name' => '住址'),
                
            );
          $info = array(
            ['name'=>'阿修罗','age'=>'11','identity'=>'杀手','address'=>'地狱'],
            ['name'=>'释迦摩尼','age'=>'>&','identity'=>'传销','address'=>'西方'],
            ['name'=>'李世民','age'=>'60','identity'=>'皇帝','address'=>'洛阳'],
            ['name'=>'朱元璋','age'=>'70','identity'=>'乞丐','address'=>'朱庄']
        );
        $data_zd = array('name','age','identity','address');
		 
		 $header = base64_encode(serialize($header));
		 $info = base64_encode(serialize($info));
		 $data_zd = base64_encode(serialize($data_zd));
		 $data['header'] = $header;
     $data['data'] = $info;
     $data['data_zt'] = $data_zd;
     $data['file_name'] = '测试导出';
	 // dump($data);die;
		   $url = 'http://common.songshinet.com/index/Excel/export';
			$res = $this->curl_post($url,$data);
			dump($res);
    }

    public function hello()
    {
		
       
		
    }
	
	 function curl_post( $url, $postdata ) {
     
       $header = array(
           'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
           'User-Agent:Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.105 Safari/537.36'
        );
     
        //初始化
        $curl = curl_init();
        //设置抓取的url
        curl_setopt($curl, CURLOPT_URL, $url);
        //设置头文件的信息作为数据流输出
        curl_setopt($curl, CURLOPT_HEADER, 0);
        //设置获取的信息以文件流的形式返回，而不是直接输出。
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        // 超时设置
        curl_setopt($curl, CURLOPT_TIMEOUT, 10);
           
             curl_setopt($curl, CURLOPT_POST, 1);

        // 超时设置，以毫秒为单位
        // curl_setopt($curl, CURLOPT_TIMEOUT_MS, 500);
     
        // 设置请求头
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
     
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE );
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE );
     
        //设置post方式提交
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $postdata);
        //执行命令
        $data = curl_exec($curl);
     
        // 显示错误信息
        if (curl_error($curl)) {
            print "Error: " . curl_error($curl);
        } else {
            // 打印返回的内容
            var_dump($data);
            curl_close($curl);
        }
    }
}
