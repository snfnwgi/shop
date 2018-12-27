<?php
/**
 * 定时拉抓取 1小时执行一次
 *
 */
include('Common_func.php');
include('function.php');

$min_id = 1;
$hour = date('G');

while(true) {
    $list_api = "http://v2.api.haodanku.com/timing_items/apikey/allfree/start/{$hour}/end/{$hour}/back/1000/min_id/" . $min_id;

    $list = get_curl($list_api);
    if (empty($list['data'])) {
        echo 'empty';
        exit;
    }
    $min_id = $list['min_id'];

    $insert_sql = '';
    foreach ($list['data'] as $val) {
        $insert = [
            'min_id' => $val['product_id'],
            'itemid' => $val['itemid'],
            'activityid' => $val['activityid'],
            'sellerid' => $val['userid'],
            'itemshorttitle' => $val['itemshorttitle'],
            'itemdesc' => $val['itemdesc'],
            'itemprice' => $val['itemprice'],
            'itemendprice' => $val['itemendprice'],
            'itemsale' => $val['itemsale'],
            'itempic' => $val['itempic'],
            'couponnum' => $val['couponnum'],
            'couponreceive' => $val['couponreceive'],
            'couponmoney' => $val['couponmoney'],
            'couponexplain' => $val['couponexplain'],
            'couponstarttime' => $val['couponstarttime'],
            'couponendtime' => $val['couponendtime'],
            'shoptype' => $val['shoptype'],
            'taobao_image' => implode(',', explode(',', $val['taobao_image'])),
            'itempic_copy' => $val['itempic_copy'],
            'fqcat' => $val['fqcat'],
            'shopname' => isset($val['shopname']) ? $val['shopname'] : '',
            'tkrates' => $val['tkrates'],
            'tktype' => $val['tktype'],
            'activity_type' => $val['activity_type'],
            'videoid' => $val['videoid'],
            'status' => 1,//有效
            'created_at' => time(),
            'updated_at' => time()
        ];
        if (empty($insert_sql)) {
            $insert_sql = "insert into tb(";
            foreach ($insert as $k => $v) {
                $insert_sql .= '`' . $k . '`,';
            }
            $insert_sql = rtrim($insert_sql, ",");
            $insert_sql .= ') values';
        }

        $insert_sql .= '(';
        foreach ($insert as $v) {
            $insert_sql .= "'" . $v . "',";
        }
        $insert_sql = rtrim($insert_sql, ",");
        $insert_sql .= "),";
        //单条
        $insert_sql = rtrim($insert_sql, ",");
        $dbh->exec($insert_sql);
        $insert_sql = '';
    }

}
echo 'ok';die;