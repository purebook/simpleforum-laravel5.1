<?php
/**
 * Created by PhpStorm.
 * User: yusheng
 * Date: 17-8-22
 * Time: 下午8:13
 */

namespace App\Mailer;


class UserMailer extends Mailer
{
    public function welcome($user)
    {
        /*$subject='';
        $view='emails.welcome';
        $data=['name'=>$user->name,'token'];
        $this->sendTo($user,$subject,$view,$data);
        */
        $subject = 'Laravel 邮箱确认';
        $view = 'welcome';
        $data = ['%name%' => [$user->name],'%confirm_code%' => [$user->confirm_code]];
        $this->sendTo($user, $subject, $view, $data);

    }

    public function forget()
    {
        //
    }
}