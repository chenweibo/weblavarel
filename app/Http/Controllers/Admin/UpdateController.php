<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use \GuzzleHttp\Client;
use App\Http\Controllers\Controller;

class UpdateController extends Controller
{
    public function update()
    {
    }

    public function DetectionUpdate()
    {
        $client = new Client();
        $res = $client->request('GET', 'http://update.dqzd.com/version.text');
        $version = $res->getBody();
        if ($version == env('version')) {
            return '没有发现新版本';
        }
        return '发现新版本';
    }
    public function BackupSql()
    {
        //mysqldump -hlocalhost -uweblavarel -p weblavarel >D://dd.sql
    }
}
