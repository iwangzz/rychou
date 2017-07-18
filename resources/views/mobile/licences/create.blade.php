<!DOCTYPE html>
<!-- saved from url=(0043)http://jijin.com/admin/user-messages/create -->
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>金融牌照交易</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <script src="{{ asset('js/newRem.js') }}"></script>
    
    <link rel="stylesheet" href="{{ elixir('css/licence.css') }}">
    <link rel="stylesheet" href="/packages/admin/AdminLTE/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/packages/admin/font-awesome/css/font-awesome.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="/packages/admin/AdminLTE/dist/css/skins/skin-blue-light.min.css">

    <link rel="stylesheet" href="/packages/admin/AdminLTE/plugins/iCheck/all.css">
    <link rel="stylesheet" href="/packages/admin/AdminLTE/plugins/colorpicker/bootstrap-colorpicker.min.css">
    <link rel="stylesheet" href="/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="/packages/admin/bootstrap-fileinput/css/fileinput.min.css">
    <link rel="stylesheet" href="/packages/admin/AdminLTE/plugins/select2/select2.min.css">
    <link rel="stylesheet" href="/packages/admin/AdminLTE/plugins/ionslider/ion.rangeSlider.css">
    <link rel="stylesheet" href="/packages/admin/AdminLTE/plugins/ionslider/ion.rangeSlider.skinNice.css">
    <link rel="stylesheet" href="/packages/admin/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css">
    <link rel="stylesheet" href="/packages/admin/fontawesome-iconpicker/dist/css/fontawesome-iconpicker.min.css">

    <link rel="stylesheet" href="/packages/admin/nestable/nestable.css">
    <link rel="stylesheet" href="/packages/admin/toastr/build/toastr.min.css">
    <link rel="stylesheet" href="/packages/admin/bootstrap3-editable/css/bootstrap-editable.css">
    <link rel="stylesheet" href="/packages/admin/google-fonts/fonts.css">
    <link rel="stylesheet" href="/packages/admin/AdminLTE/dist/css/AdminLTE.min.css">

    <!-- REQUIRED JS SCRIPTS -->
    <script src="/packages/admin/AdminLTE/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script src="/packages/admin/AdminLTE/bootstrap/js/bootstrap.min.js"></script>
    <script src="/packages/admin/AdminLTE/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <script src="/packages/admin/AdminLTE/dist/js/app.min.js"></script>
    <script src="/packages/admin/jquery-pjax/jquery.pjax.js"></script>

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body class="skin-blue-light sidebar-mini sidebar-collapse">
<header class="topBar">
    <a href="http://jijin.com" class="f_l"><i class="iconFont"></i></a>
    <a href="http://jijin.com" class="f_r"><!-- <i class="iconFont">&#xe615;</i> --></a>发布牌照
</header>
<div class="wrapper" style="top:5px;">
    <div class="content-wrapper" style="min-height: 578px;">
        <section class="content-header"><h1>发布牌照</h1></section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                <div class="box box-info">
                    <form action="/licences" method="post" accept-charset="UTF-8" class="form-horizontal" pjax-container="">
                        {!! csrf_field() !!}
                        <div class="box-body">
                            <div class="fields-group">
                                <div class="form-group">
                                    <label for="category" class="col-sm-2 control-label">牌照分类</label>
                                    <div class="col-sm-8">
                                        <select class="form-control category" name="category" required>
                                            @foreach($categories as $id => $category)
                                                <option value={{ $id }}>{{ $category }}</option>
                                            @endforeach 
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="region" class="col-sm-2 control-label">牌照地区</label>
                                    <div class="col-sm-8">
                                        <select class="form-control region" name="region" required>
                                            @foreach($regions as $id => $region)
                                                <option value={{ $id }}>{{ $region }}</option>
                                            @endforeach 
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="company" class="col-sm-2 control-label">牌照所属公司</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                            <input type="text" id="company" name="company" value="" class="form-control company" placeholder="输入 牌照公司">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="price" class="col-sm-2 control-label">牌照价格</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <span class="input-group-addon">￥</span>
                                            <input style="width: 120px; text-align: right;" type="text" id="price" name="price" value="" class="form-control price" placeholder="输入 牌照价格">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="col-sm-2 control-label">姓名</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                            <input type="text" id="name" name="name" value="" class="form-control name" placeholder="输入 姓名" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="email" class="col-sm-2 control-label">邮箱</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                            <input type="email" id="email" name="email" value="" class="form-control email" placeholder="输入 邮箱" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="phone" class="col-sm-2 control-label">手机</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                            <input style="width: 150px" type="text" id="phone" name="phone" value="" class="form-control phone" placeholder="输入 手机号码" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="qq" class="col-sm-2 control-label">QQ</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                            <input type="text" id="qq" name="qq" value="" class="form-control qq" placeholder="输入 QQ" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="wechat" class="col-sm-2 control-label">微信</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                            <input type="text" id="wechat" name="wechat" value="" class="form-control wechat" placeholder="输入 微信" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="message" class="col-sm-2 control-label">留言</label>
                                    <div class="col-sm-8">
                                        <textarea name="message" class="form-control" rows="5" placeholder="输入 留言"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <!-- /.box-body -->
                        <div class="box-footer">
                            <div class="col-sm-2">
                            </div>
                            <div class="col-sm-8">
                                <div class="btn-group">
                                    <button type="submit" class="btn btn-info">提交</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                </div>
            </div>
        </section>
    </div>
</div>

<script data-exec-on-popstate="">
$(function () {
    $(".category").select2({allowClear: true});
    $(".region").select2({allowClear: true});
    $('.price').inputmask({"alias":"currency","radixPoint":".","prefix":"","removeMaskOnSubmit":true});
    $('.phone').inputmask({"mask":"99999999999"});
});
</script>
<!-- ./wrapper -->
<!-- REQUIRED JS SCRIPTS -->
<script src="/packages/admin/AdminLTE/plugins/chartjs/Chart.min.js"></script>
<script src="/packages/admin/nestable/jquery.nestable.js"></script>
<script src="/packages/admin/toastr/build/toastr.min.js"></script>
<script src="/packages/admin/bootstrap3-editable/js/bootstrap-editable.min.js"></script>

<script src="/packages/admin/AdminLTE/plugins/iCheck/icheck.min.js"></script>
<script src="/packages/admin/AdminLTE/plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
<script src="/packages/admin/AdminLTE/plugins/input-mask/jquery.inputmask.bundle.min.js"></script>
<script src="/packages/admin/moment/min/moment-with-locales.min.js"></script>
<script src="/packages/admin/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
<script src="/packages/admin/bootstrap-fileinput/js/plugins/canvas-to-blob.min.js"></script>
<script src="/packages/admin/bootstrap-fileinput/js/fileinput.min.js"></script>
<script src="/packages/admin/AdminLTE/plugins/select2/select2.full.min.js"></script>
<script src="/packages/admin/number-input//bootstrap-number-input.js"></script>
<script src="/packages/admin/AdminLTE/plugins/ionslider/ion.rangeSlider.min.js"></script>
<script src="/packages/admin/bootstrap-switch/dist/js/bootstrap-switch.min.js"></script>
<script src="/packages/admin/fontawesome-iconpicker/dist/js/fontawesome-iconpicker.min.js"></script>
</body></html>