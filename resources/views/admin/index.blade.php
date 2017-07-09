@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-sm-3">
        <div class="widget lazur-bg">
            <div class="row">
                <div class="col-xs-4 text-center">
                    <i class="fa fa-compass fa-5x"></i>
                </div>
                <div class="col-xs-8 text-right">
                    <span> 总访问量 </span>
                    <h2 class="font-bold">{$liulan}</h2>
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
                    <h2 class="font-bold">{$ip}</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="widget style1 lazur-bg">

            <div class="row"> <a  class="nav nav-second-level collapse in" aria-expanded="true" href="{:url('product/contentlist')}" data-indent="9"  style="color: #fff;">

                <div class="col-xs-4">
                    <i class="fa fa-th-large fa-5x"></i>
                </div>
                <div class="col-xs-8 text-right">
                    <span> 产品数量 </span>
                    <h2 class="font-bold">{$pronum}</h2>
                </div>  </a>
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
                    <h2 class="font-bold">{$articlenum}</h2>
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
                    <h2 class="font-bold">{$pagenum}</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="widget lazur-bg" style="background-color: #ec971f;">
            <div class="row">
                <div class="col-xs-4 text-center">
                    <i class="fa fa-cloud-download fa-5x"></i>
                </div>
                <div class="col-xs-8 text-right">
                    <span> 下载数量 </span>
                    <h2 class="font-bold">{$downnum}</h2>
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
                    <h2 class="font-bold">{$imgnum}</h2>
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
                    <h2 class="font-bold">{$gbooknum}</h2>
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
                    {volist name="info" id="v"}
                    <tr>
                        <td>{$key}</td>
                        <td>{$v}</td>

                    </tr>
                    {/volist}


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
                        <td>程序版本（2.0）</td>
                        <td><a class="btn btn-primary btn-xs" href="#" role="button">检查更新</a></td>

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

@endsection
