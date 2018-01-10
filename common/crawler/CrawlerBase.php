<?php

namespace common\crawler;

use JonnyW\PhantomJs\Client;
use JonnyW\PhantomJs\DependencyInjection\ServiceContainer;

class CrawlerBase
{

    public function getContent($url, $isPhantom = false, $procedureName = '')
    {
        if ($isPhantom) {
            $location = __DIR__ . '/procedure';//自定义模块所在文件夹
            $serviceContainer = ServiceContainer::getInstance();
            $procedureLoader = $serviceContainer->get('procedure_loader_factory')->createProcedureLoader($location);//详细参见本文页尾

            /*正常实例*/
            $client = Client::getInstance();//实例


            /*自定义模块*/
            $client->setProcedure($procedureName);//加载一个名为my_procedure.proc的自定义js模块,详见本文页尾
            $client->getProcedureLoader()->addLoader($procedureLoader);//自动加载模块

            /*自设phantomjs参数*/
            //--debug=[true|false]
            //--cookies-file=/path/to/cookies.txt
            //--ignore-ssl-errors=[true|false]
            $client->getEngine()->addOption('--debug=true');
            $client->getEngine()->addOption('--cookies-file=' . __DIR__ . '/cookies/cookies.txt');
            $client->getEngine()->addOption('--ignore-ssl-errors=true');

            /*调试与缓存*/
            $client->getEngine()->debug(true);//允许或禁止调试
            $client->getLog(); //开启调试则输出结果
            $client->getProcedureCompiler()->clearCache();//清除缓存.建议允许前进行清除
            $client->getProcedureCompiler()->enableCache();//允许缓存,建议开启
//            $client->getProcedureCompiler()->disableCache();//禁止读取缓存


            /*渲染与请求方式*/
            $client->isLazy(); // 是否让客户端等待所有资源加载完毕,开启此项务必开始setTimeout,避免轮询页面不断等待.
            $request = $client->getMessageFactory()->createRequest();
            $response = $client->getMessageFactory()->createResponse();
            $request->setUrl($url);
            $request->setMethod('GET');//可GET|POST|OPTIONS|HEAD|DELETE|PATCH|PUT
            $request->setTimeout(10000);//超过指定时间则中断渲染
//            $request->setDelay(5);//设置延迟5秒
//            $request->setRequestData(array('param1' => 'Param 1','param2' => 'Param 2'));//POST时发送的数据
//            $request->addHeader('custom_header_key', 'custom_header_value');//自定义头信息
            $client->send($request, $response);//发送请求

            /*响应结果*/
            $response->getHeaders();//返回头组成的数组
            $response->getHeader();//返回头
            $response->getStatus();//返回状态码:200则正确,其余错误.
            $response->getContent();//返回正文
            $response->getContentType();//返回正文类型
            $response->getUrl();//返回请求地址
            $response->getRedirectUrl();//返回重定向后的地址
            $response->isRedirect();//返回是否重定向
            $response->getConsole();//返回JS控制台内容
        }
        $client = new \GuzzleHttp\Client();
        try {
            $res = $client->request('GET', $url);

            if ($res->getStatusCode() == 200) {
                return (String)$res->getBody();
            }
        } catch (\Exception $e) {
            return null;
        }


        return null;

    }

}

?>