@extends('layouts.admin')

@section('content')

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-8">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>基本设置</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="form_basic.html#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <form class="form-horizontal m-t" id="commentForm" method="post" onsubmit="return toVaild()">

                            <div class="form-group">
                                <label class="col-sm-3 control-label">站点名称：</label>
                                <div class="input-group col-sm-4">
                                    <input id="site_title" type="text" class="form-control" name="title"
                                           value="{{ $data['title'] }}" aria-required="true">
                                </div>
                            </div>
                            <div class="form-group" @if(config('admin.lang') == 1) style="display:block"  @else style="display:none" @endif>
                                <label class="col-sm-3 control-label">英文站点名称：</label>
                                <div class="input-group col-sm-4">
                                    <input id="site_title" type="text" class="form-control" name="en_title"
                                           value="{{ $data['en_title'] }}" aria-required="true">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">站点关键字：</label>
                                <div class="input-group col-sm-4">
                                    <input id="site_keywords" type="text" class="form-control"
                                           value="{{ $data['keywords'] }}" name="keywords" aria-required="true">
                                </div>
                            </div>
                            <div class="form-group" @if(config('admin.lang') == 1) style="display:block"  @else style="display:none" @endif>
                                <label class="col-sm-3 control-label">英文站点描述：</label>
                                <div class="input-group col-sm-4">
                                    <input id="en_description" type="text" class="form-control"
                                           value="{{ $data['en_description'] }}" name="en_description" aria-required="true">

                                </div>
                            </div>

                            <div class="form-group" @if(config('admin.lang') == 1) style="display:block"  @else style="display:none" @endif>
                                <label class="col-sm-3 control-label">英文站点关键字：</label>
                                <div class="input-group col-sm-4">
                                    <input id="en_keywords" type="text" class="form-control"
                                           value="{{ $data['en_keywords'] }}" name="en_keywords" aria-required="true">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">站点描述：</label>
                                <div class="input-group col-sm-4">
                                    <input id="site_description" type="text" class="form-control"
                                           value="{{ $data['description'] }}" name="description" aria-required="true">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">电话号码：</label>
                                <div class="input-group col-sm-4">
                                    <input id="site_tel" type="text" class="form-control" name="tel"
                                           value="{{ $data['tel'] }}" aria-required="true">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">手机号码：</label>
                                <div class="input-group col-sm-4">
                                    <input id="site_phone" type="text" class="form-control" name="phone"
                                           value="{{ $data['phone'] }}" aria-required="true">

                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-sm-3 control-label">邮政编码：</label>
                                <div class="input-group col-sm-4">
                                    <input id="site_code" type="text" class="form-control" name="code"
                                           value="{{ $data['code'] }}" aria-required="true">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">企业邮箱：</label>
                                <div class="input-group col-sm-4">
                                    <input id="site_mail" type="text" class="form-control" name="mail"
                                           value="{{ $data['mail'] }}" aria-required="true">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">传真：</label>
                                <div class="input-group col-sm-4">
                                    <input id="site_fax" type="text" class="form-control" name="fax"
                                           value="{{ $data['fax'] }}" aria-required="true">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">地址：</label>
                                <div class="input-group col-sm-4">
                                    <input id="site_address" type="text" class="form-control" name="address"
                                           value="{{ $data['address'] }}" aria-required="true">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">备案号：</label>
                                <div class="input-group col-sm-4">
                                    <input id="icp" type="text" class="form-control" name="icp"
                                           value="{{ $data['icp'] }}" aria-required="true">

                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-3">
                                    <!--<input type="button" value="提交" class="btn btn-primary" id="postform"/>-->
                                    <button class="btn btn-primary" type="submit">提交</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <script src="{{asset('static/admin/js/content.min.js?v=1.0.0')}}"></script>
    <script src="{{asset('static/admin/js/plugins/validate/jquery.validate.min.js')}}"></script>
    <script src="{{asset('static/admin/js/plugins/validate/messages_zh.min.js')}}"></script>
    <script src="{{asset('static/admin/js/plugins/sweetalert/sweetalert.min.js')}}"></script>
    <script src="{{asset('static/admin/js/plugins/layer/layer.min.js')}}"></script>

    <script type="text/javascript">

        function toVaild() {
            var jz;
            var url = "{{ route('site')}}";
            $.ajax({
                type: "POST",
                url: url,
                data: $('#commentForm').serialize(),// 你的formid
                async: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function () {
                    jz = layer.load(0, {shade: false}); //0代表加载的风格，支持0-2
                },
                error: function (request) {
                    layer.close(jz);
                    swal("网络错误!", "", "error");

                },
                success: function (data) {
                    //关闭加载层
                    layer.close(jz);
                    if (data.code == 1) {
                        swal(data.msg, "", "success");
                    } else {
                        swal(data.msg, "", "error");
                    }
                }
            });

            return false;
        }
    </script>



@endsection
