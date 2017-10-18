<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Tymon\JWTAuth\Contracts\JWTSubject as AuthenticatableUserContract;

class AdminUser extends Model
{
    protected $table = 'admin_user';
    public $timestamps = false;


    public function InsertUser($param)
    {
        try {
            $validator = Validator::make(
                $param,
              [
                  'username' => 'unique:admin_user',
              ],
                [
                  'username.unique' => '用户名已经存在',
              ]
            );
            if ($validator->fails()) {
                $errors = $validator->errors()->all();

                return ['code' => -1,'data' => '', 'msg' => $errors[0]];
            } else {
                $this->insert($param);
                return ['code' => 1, 'data' => '', 'msg' => '添加用户成功'];
            }
        } catch (PDOException $e) {
            return ['code' => -2, 'data' => '', 'msg' => $e->getMessage()];
        }
    }

    public function EditUser($param)
    {
        try {
            $this->where('id', $param['id'])->update($param);
            return ['code' => 1, 'data' => '', 'msg' => '更新用户成功'];
        } catch (PDOException $e) {
            return ['code' => -2, 'data' => '', 'msg' => $e->getMessage()];
        }
    }

    public function DelUser($id)
    {
        try {
            $this->where('id', $id)->delete();
            return ['code' => 1, 'data' => '', 'msg' => '删除管理员成功'];
        } catch (PDOException $e) {
            return ['code' => 0, 'data' => '', 'msg' => $e->getMessage()];
        }
    }
}
