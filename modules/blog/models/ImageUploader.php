<?php

namespace blog\models;

class imageUploader
{
    private const CLIENT_ID = "a3c7f8605115b04";
    private const API_URL = "https://api.imgur.com/3/image";
    private const MAX_SIZE_LIMIT = 1e+7;

    public static function uploadPicture($file_info){
        // check if file is a real image and is under the size limit
        if (getimagesize($file_info["tmp_name"]) && $file_info['size'] < self::MAX_SIZE_LIMIT){
            $image_source = file_get_contents($file_info['tmp_name']);
            $postFields = array('image' => base64_encode($image_source));
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, self::API_URL);
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Client-ID ' . self::CLIENT_ID));
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
            $response = curl_exec($ch);
            curl_close($ch);
            $imgurData = json_decode($response);
            // check a imgur link was created
            if(!empty($imgurData->data->link)){
                return $imgurData;
            }
        }
        return false;
    }
}