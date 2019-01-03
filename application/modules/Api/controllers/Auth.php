<?php
#配置
class AuthController extends ApiController
{

    function init()
    {
        parent::init();
    }

    function configAction(){
        $data = array(
            'category' => [
                [
                    'cid' => '0',
                    'name' => '精选'
                ],
                [
                    'cid' => '1',
                    'name' => '女装'
                ],
                [
                    'cid' => '2',
                    'name' => '男装'
                ],
                [
                    'cid' => '3',
                    'name' => '内衣'
                ],
                [
                    'cid' => '4',
                    'name' => '美妆'
                ],
                [
                    'cid' => '5',
                    'name' => '配饰'
                ],
                [
                    'cid' => '6',
                    'name' => '鞋品'
                ],
                [
                    'cid' => '7',
                    'name' => '箱包'
                ],
                [
                    'cid' => '8',
                    'name' => '儿童'
                ],
                [
                    'cid' => '9',
                    'name' => '母婴'
                ],
                [
                    'cid' => '10',
                    'name' => '居家'
                ],
                [
                    'cid' => '11',
                    'name' => '美食'
                ],
                [
                    'cid' => '12',
                    'name' => '数码'
                ],
                [
                    'cid' => '13',
                    'name' => '家电'
                ],
                [
                    'cid' => '15',
                    'name' => '车品'
                ],
                [
                    'cid' => '16',
                    'name' => '文体'
                ],
                [
                    'cid' => '14',
                    'name' => '其他'
                ]
            ],
            'tab' => [
                '首页',
                '分类',
                '我的'
            ],
            'wechat' => [
                'url' => 'http://img.wzzsl.com/11121647195bd3427ea1d840.19166580.jpg',
                'name' => 'quangoushengqian'
            ]
        );

        $this->responseJson(self::SUCCESS_CODE, self::SUCCESS_MSG, $data);
    }


    #banner 广告位
    function bannerAction(){
        $banner_model = new BannerModel();
        $page =1;
        $page_size =20;
        $condition = [
            'position' => 'banner',
        ];
        $show_list = $banner_model->getListData($page,$page_size,$condition);
        $banner = [];
        foreach($show_list as $val){
            $banner[] = [
                'pic' => CommonModel::IMAGE_URL . $val['pic'],
                'type' => $val['type'],
                'goto' => $val['goto'],
            ];
        }
        $data = [
            'banner' => $banner,
        ];
        $this->responseJson(self::SUCCESS_CODE, self::SUCCESS_MSG, $data);
    }

    #安卓更新
    function androidUpdateAction(){

        //小米渠道，审核中：返回空给客户端（因为审核中时不能有提示）

        $data = [
            'versionName' => '1.1.0',
            'versionCode' => '2',
            'forceUpdate' => 'n',//强制更新(y-是 n-否)
            'applicationId' => '',//包名
            'url' => CommonModel::IMAGE_URL.'package_5271_1517565084.apk',
        ];

        $this->responseJson(self::SUCCESS_CODE, self::SUCCESS_MSG, $data);
    }

}