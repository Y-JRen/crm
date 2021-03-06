<?php
use common\logic\LinkPager;
?>
<link href="/dist/css/home/bootstrap.css" rel="stylesheet">
<link href="/dist/css/home/AdminLTE.min.css" rel="stylesheet">
<link href="/dist/css/style.css" rel="stylesheet">
<script src="/dist/js/jquery-1.7.1.js"></script>
<div class="box box-none-border">
    <div class="box-body no-padding">
        <div class="table-responsive">
            <div>
                <h1 class="page-title pdb-0 mt-sm mb-md"><?php echo $title;?></h1>
            </div>
            <div style="margin: 10px 10px 10px 0px;">
                <form id="form1" action="/detailed/car" method="get">
                    <input type="hidden" name="level" value="<?php echo $get['level']?>">
                    <input type="hidden" name="type" value="<?php echo $get['type']?>">
                    <input type="hidden" name="id" value="<?php echo $get['id']?>">
                    <input type="hidden" name="shop_id" value="<?php echo empty($get['shop_id']) ? 0 :$get['shop_id']?>">
                    <input type="hidden" name="addtime" value="<?php echo $get['addtime']?>">
                    <input type="hidden" name="ischeck" id="ischeck" value="<?php echo $get['ischeck'];?>">
                    <input class="btn btn-primary" value="导出列表" type="button" onclick="butCheck(1)">
                    <div class="row">
                        <div class="col-sm-12 t-r">
                            <div class="pull-right mr-15">
                                <div class="col-sm-9 col-md-9">
                                    <input class="form-control" type="text" style="width:200px;" id="keyword" name="keyword" value="<?php echo $get['keyword'];?>" placeholder="姓名/手机号码/顾问">
                                </div>
                                <input class="btn btn-primary btn-sm pull-left mr-15" value="查询" type="button" onclick="butCheck(0)" >
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <table class="table table-hover table-bordered table-list-check">
                <thead>
                <tr style="font-size: 14px;">
                    <th>序号</th>
                    <th><?php echo $get['type'] == 0 ? '订车时间（财务到账）' : '购车时间'; ?></th>
                    <th>姓名</th>
                    <th>手机号码</th>
                    <th>信息来源</th>
                    <th>订车车型</th>
                    <th>建卡时间</th>
                    <th>最近联系</th>
                    <?php if ($get['type'] == 0) { ?>
                        <th>状态</th>
                    <?php } ?>
                    <th>顾问</th>
                </tr>
                </thead>
                <tbody>
                <?php if ($list) {
                foreach ($list as $k => $v) {
                    $page = empty($_GET['page']) ? 1 : $_GET['page']; ?>
                    <tr style="font-size: 14px;">
                    <td><?php echo (($page - 1) * 20) + ($k + 1); ?></td>
                    <?php if ($get['type'] == 0) { ?>
                        <td><?php echo empty($v['cai_wu_dao_zhang_time']) ? '--' : $v['cai_wu_dao_zhang_time'] ?></td>
                        <?php }else{ ?>
                            <td><?php echo empty($v['car_delivery_time']) ? '--' : $v['car_delivery_time'] ?></td>
                        <?php } ?>
                        <td>
                            <!--客户姓名-->
                            <?php echo empty($v['customer_name']) ? '--' : $v['customer_name'] ?>
                        </td>
                        <td>
                            <!--客户手机号-->
                            <?php echo empty($v['customer_phone']) ? '--' : $v['customer_phone'] ?>
                        </td>
                        <td><?php echo empty($v['source_name']) ? '--' : $v['source_name']; ?></td>
                        <td><?php echo empty($v['car_type_name']) ? '--' : $v['car_type_name']; ?></td>
                        <td><?php echo empty($v['create_card_time']) ? '--' : $v['create_card_time']; ?></td>
                        <td><?php echo empty($v['last_view_time']) ? '--' : $v['last_view_time']; ?></td>
                        <?php if ($get['type'] == 0) { ?>
                            <td><?php echo $v['statusDes'];?></td>
                        <?php } ?>
                        <td><?php echo empty($v['salesman_name']) ? '--' : $v['salesman_name']; ?></td>
                        </tr>
                    <?php }
                } ?>
                </tbody>
            </table>
        </div>
        <div class="box-footer clearfix bd-t0" style="text-align:right;">
            <?php

            // 显示分页
            echo LinkPager::widget([
                'pagination' => $pagination,
                'firstPageLabel' => "首页",
                'prevPageLabel' => '上一页',
                'nextPageLabel' => '下一页',
                'lastPageLabel' => '末页',
            ]);
            ?>
        </div>
    </div>
</div>
<script type="text/javascript">
    function butCheck(butNum) {
        $('#ischeck').val(butNum)
        $('#form1').submit();
    }
</script>