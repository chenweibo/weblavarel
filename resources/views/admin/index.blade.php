@extends('layouts.admin')

@section('content')
  <div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">

        <div class="col-sm-3">
            <div class="widget lazur-bg style1">
                <div class="row">
                    <div class="col-xs-4 text-center">
                        <i class="fa fa-compass fa-5x"></i>
                    </div>
                    <div class="col-xs-8 text-right">
                        <span> 总访问量 </span>
                        <h2 class="font-bold">{{$data['total']}}</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="widget style1 navy-bg">
                <div class="row">
                    <div class="col-xs-4">
                        <i class="fa fa-bolt fa-5x"></i>
                    </div>
                    <div class="col-xs-8 text-right">
                        <span> 今日访问量 </span>
                        <h2 class="font-bold">{{ $data[date('Ymd')] or '0' }}</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="widget style1 lazur-bg">

                <div class="row">
                        <div class="col-xs-4">
                            <i class="fa fa-th-large fa-5x"></i>
                        </div>
                        <div class="col-xs-8 text-right">
                            <span> 产品数量 </span>
                            <h2 class="font-bold">{{$product}}</h2>
                        </div>
                </div>


            </div>
        </div>
        <div class="col-sm-3">
            <div class="widget style1 yellow-bg">
                <div class="row">
                    <div class="col-xs-4">
                        <i class="fa fa-book fa-5x"></i>
                    </div>
                    <div class="col-xs-8 text-right">
                        <span> 文章数量 </span>
                        <h2 class="font-bold">{{$article}}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-sm-3">
            <div class="widget style1 lazur-bg" style="background-color: #5bc0de;">
                <div class="row">
                    <div class="col-xs-4">
                        <i class="fa fa-pencil-square-o fa-5x"></i>
                    </div>
                    <div class="col-xs-8 text-right">
                        <span> 单篇 </span>
                        <h2 class="font-bold">{{$page}}</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="widget style1 lazur-bg" style="background-color: #ec971f;">
                <div class="row">
                    <div class="col-xs-4 text-center">
                        <i class="fa fa-cloud-download fa-5x"></i>
                    </div>
                    <div class="col-xs-8 text-right">
                        <span> 下载数量 </span>
                        <h2 class="font-bold">{{$down}}</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="widget style1 navy-bg" style="background-color: #337ab7;">
                <div class="row">
                    <div class="col-xs-4">
                        <i class="fa fa-file-image-o fa-5x"></i>
                    </div>
                    <div class="col-xs-8 text-right">
                        <span> 图片数量 </span>
                        <h2 class="font-bold">{{$image}}</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-3">
            <div class="widget style1 yellow-bg" style="background-color: #6c62e7;">
                <div class="row">
                    <div class="col-xs-4">
                        <i class="fa fa-commenting-o fa-5x"></i>
                    </div>
                    <div class="col-xs-8 text-right">
                        <span> 留言数量 </span>
                        <h2 class="font-bold">{{$gbook}}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-sm-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>服务器信息</h5>
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

                    <table class="table table-bordered">
                        <thead>
                        <tr>

                            <th>项目</th>
                            <th>状态</th>

                        </tr>
                        </thead>
                        <tbody>

                        <tr>
                            <td>ip</td>
                            <td>@php
                                    echo ' [ '.gethostbyname($_SERVER['SERVER_NAME']).' ]';
                                @endphp</td>
                        </tr>
                        <tr>
                            <td>域名</td>
                            <td>@php
                                    echo $_SERVER['SERVER_NAME'];
                                @endphp</td>
                        </tr>
                        <tr>
                            <td>操作系统</td>
                            <td>@php
                                    echo PHP_OS;
                                @endphp</td>
                        </tr>
                        <tr>
                            <td>运行环境</td>
                            <td>@php
                                    echo $_SERVER["SERVER_SOFTWARE"];
                                @endphp</td>
                        </tr>
                        <tr>
                            <td>php版本</td>
                            <td>@php
                                    echo PHP_VERSION;
                                @endphp</td>
                        </tr>
                        <tr>
                            <td>上传附件限制</td>
                            <td>@php
                                    echo ini_get('upload_max_filesize');
                                @endphp</td>
                        </tr>
                        <tr>
                            <td>执行时间限制</td>
                            <td>@php
                                    echo ini_get('max_execution_time').'秒';
                                @endphp</td>
                        </tr>
                        <tr>
                            <td>当前时间</td>
                            <td id="systemtime">@php
                                    echo date("Y年n月j日 H:i:s");
                                @endphp</td>
                        </tr>

                        <tr>
                            <td>剩余空间</td>
                            <td>@php
                                    echo round((disk_free_space(".")/(1024*1024)),2).'M';
                                @endphp</td>
                        </tr>


                        </tbody>
                    </table>

                </div>
            </div>

        </div>

        <div class="col-sm-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>其他信息</h5>
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

                    <table class="table table-bordered">
                        <thead>
                        <tr>

                            <th>项目</th>
                            <th>状态</th>

                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>程序版本（{{env('version')}}）</td>
                            <td><a class="btn btn-primary btn-xs" onclick="DetectionUpdate()" role="button">检查更新</a></td>

                        </tr>
                        <tr>
                            <td>站点地图</td>
                            <td><a class="btn btn-primary btn-xs" onclick="sitemap()" role="button">生成</a></td>
                        </tr>
                        <tr>
                            <td>图片水印功能</td>
                            <td>否</td>

                        </tr>
                        <tr>
                            <td>邮件配置</td>
                            <td>否</td>

                        </tr>


                        </tbody>
                    </table>

                </div>
            </div>

        </div>
    </div>
</div>
            <script src="{{asset('static/admin/js/plugins/layer/layer.min.js')}}"></script>
            <script src="{{asset('static/admin/js/other.js')}}"></script>
            <script type="text/javascript">

            function systemTime(){
              var date = new Date();
     var seperator1 = "年";
     var seperator2 = "月";
     var seperator3 = "日";
     var seperator4 = ":";
     var month = date.getMonth() + 1;
     var strDate = date.getDate();
     if (month >= 1 && month <= 9) {
         month;
     }
     if (strDate >= 0 && strDate <= 9) {
         strDate = "0" + strDate;
     }
     var currentdate = date.getFullYear() + seperator1 + month + seperator2 + strDate
             + seperator3 +' '+ date.getHours() + seperator4 + date.getMinutes()
             + seperator4 + date.getSeconds();

                  $('#systemtime').html(currentdate);

            }



                 setInterval(function(){
                 systemTime();
                 },1000);


            </script>
@endsection
