<?php

namespace App\Helpers;


use App\User;
use Config;
use Gate;
use Illuminate\Support\Facades\Auth;

use App\Models\ModelHasRoles;
use App\Models\RoleHasPermission;
use App\Models\Permissions;
use App\Models\Admin\RolePermission;
use App\Models\Admin\UserProjects;
use Mail;

/**
* Class to store the entire group tree
*/
class GeneralHelper
{
/**
* Initializer
*/

    public static  function sendMail($from=null, $to=null,  $veiwPath, $dataArray, $subject=null, $cc=null, $bcc=null){
//        dd($dataArray);
        Mail::send($veiwPath,['mailData'=> $dataArray], function ($m) use($to, $from, $subject){
            $m->from($from, 'Locum Set');
            $m->to($to);
            $m->subject($subject);
            return true;

        });
    }

    public static function isBetween($from, $till, $input) {
        $fromTime = strtotime($from);
        $toTime = strtotime($till);
        $inputTime = strtotime($input);

        return($inputTime >= $fromTime and $inputTime <= $toTime);
    }


    public static function sendGCM($registration_ids, $title, $body, $data) {
//dd('ok ');
        $url = "https://fcm.googleapis.com/fcm/send";
        $token = $registration_ids[0];

        // $serverKey = 'AAAAqbfRzJY:APA91bEx4jO8JTXlxFIE3SqXjR0t6e9Lsly0vp9LaW2FwMg-qWtpVzM0n8RKSp2HAwyMgxLjkAUW-wTU0FMbos6ICjVGsXGsm55w8jCwz6mei7Pg_uj_0RoRyDKkSzHLEUCx3Jmm44no';
        $serverKey = 'AAAAqbfRzJY:APA91bEBo9kdMVLEZfVRJuL5Ww0OLvMCLBpVwgXKkO3eY1cFkPWkyb1CliVzDDoxQhmOXIzWry_HPLN-bxtpsO9I7-RBWokHaNKcobUScXoaJXzXaczc2fTqTV8bs3Fv-OBhImqt4J5V';
        $notification = array('title' =>$title , 'body' => $body, 'sound' => 'default', 'icon' => '/icon-128x128.png');



        $arrayToSend = array('registration_ids' => $registration_ids, 'notification' => $notification,'priority'=>'high','data' => $data);
        if(count($registration_ids) == 1){
            $arrayToSend = array('to' => $token, 'notification' => $notification,'priority'=>'high', 'sound' => 'default','data' => $data);
        }

        $json = json_encode($arrayToSend);
        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: key='. $serverKey;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
        //Send the request
        $response = curl_exec($ch);
        //Close request
        if ($response === FALSE) {
            die('FCM Send Error: ' . curl_error($ch));
        }

        curl_close($ch);
//dd('ok');
    }
    public static function sendWeb($token, $title, $body, $click_action_url){

        $key = 'AAAAqbfRzJY:APA91bGZ87b_03boYCPBpyRV8LtzMaMMAbknliZvdK03h7ls2-c_MiJJlSbV7troO2fJ25_NhAHPuUw0KrKQTw1X6-U2-OhSQopNw5GNcPi8nch3o0xIJiUUM4RttipXNh4xDguSrwwc';
//        $token = 'fn1hoiE86tv166W4NeyrUd:APA91bEyhYMKNGB--k4LRzMJ4IwmrQv8ZUov2rXSMzHbWho_Xmm1hBySZbQsnr-DW03Lw3GPUHiQ_FIXOOmOfq1en7Yuqyo4z25TBNUYiYJKSZSEugzxczuYDRj73smD94JY31zfd6zh';
        $data = array("to" => $token, "notification" => array( "title" => $title, "body" => $body,"icon" => "icon.png", "click_action" => $click_action_url));
        $data_string = json_encode($data);
        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: key='. $key;

        $ch = curl_init(); curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, $data_string);
        $result = curl_exec($ch);
        curl_close ($ch);

    }

}