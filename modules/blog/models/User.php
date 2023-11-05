<?php

namespace modules\blog\models;

require '/home/yuta/www/_assets/includes/autoloader.php';
include_once '/home/yuta/www/modules/blog/models/imageUploader.php';

use blog\models\imageUploader;
use _assets\includes\Database;
use DateTime;

class User
{
    private int $id;

    private string $mail_address;

    private string $username;

    private string $password;

    private string $profile_picture;

    private DateTime $first_login;

    private DateTime $last_login;

    private bool $active;

    private string $verification_code;

    private DateTime $verif_code_send_date;

    /**
     * @param $user_data
     */
    public function __construct($user_data)
    {
        $this->id = $user_data['ID_USER'];
        $this->mail_address = $user_data['MAIL_ADDRESS'];
        $this->username = $user_data['USERNAME'];
        $this->password = $user_data['PASSWORD'];
        $this->profile_picture = $user_data['PROFILE_PICTURE'] ?? 'null';
        $this->first_login = DateTime::createFromFormat( "Y-m-d H:i:s",$user_data['FIRST_LOGIN'],
            new \DateTimeZone('Europe/Berlin'));
        $this->last_login = DateTime::createFromFormat( "Y-m-d H:i:s",$user_data['LAST_LOGIN'],
            new \DateTimeZone('Europe/Berlin'));
        $this->active = $user_data['ACTIVE'];
        $this->verification_code = $user_data['VERIFICATION_CODE'];
        $this->verif_code_send_date = DateTime::createFromFormat( "Y-m-d H:i:s",$user_data['VERIF_CODE_SEND_DATE'],
            new \DateTimeZone('Europe/Berlin'));
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return void
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getMailAddress(): string
    {
        return $this->mail_address;
    }

    /**
     * @param string $mail_address
     * @return void
     */
    public function setMailAddress(string $mail_address): void
    {
        $this->mail_address = $mail_address;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return void
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return void
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getProfilePicture(): string
    {
        return $this->profile_picture;
    }

    /**
     * @param string $profile_picture
     * @return void
     */
    public function setProfilePicture(string $profile_picture): void
    {
        $this->profile_picture = $profile_picture;
    }

    /**
     * @return DateTime
     */
    public function getFirstLogin(): DateTime
    {
        return $this->first_login;
    }

    /**
     * @param DateTime $first_login
     * @return void
     */
    public function setFirstLogin(DateTime $first_login): void
    {
        $this->first_login = $first_login;
    }

    /**
     * @return DateTime
     */
    public function getLastLogin(): DateTime
    {
        return $this->last_login;
    }

    /**
     * @param DateTime $last_login
     * @return void
     */
    public function setLastLogin(DateTime $last_login): void
    {
        $this->last_login = $last_login;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @param bool $active
     * @return void
     */
    public function setActive(bool $active): void
    {
        $this->active = $active;
    }

    /**
     * @return string
     */
    public function getVerificationCode(): string
    {
        return $this->verification_code;
    }

    /**
     * @param string $verification_code
     * @return void
     */
    public function setVerificationCode(string $verification_code): void
    {
        $this->verification_code = $verification_code;
    }

    /**
     * @return bool
     */
    public function isAdmin(): bool
    {
        return false;
    }

    /**
     * @return bool
     */
    public function sendVerificationCode(): bool
    {
        $subject = 'Votre code de vérification YUTA';
        $message = 'Votre code de vérification est :'.$this->verification_code.'.';
        $headers = "From: yuta@yutaa.com";
        return mail($this->getMailAddress(), $subject, $message, $headers);
    }

    public function sendForgetPasswordCode($code): bool
    {
        $subject = 'Votre code de vérification YUTA';
        $format = "Voici votre nouveau mot de passe: %s. (expirant dans une heure) (ne l'oubliez pas cette fois :D)";
        $headers = "From: yuta@yutaa.com";
        return mail($this->getMailAddress(), $subject, sprintf($format,$code,$this->id), $headers);
    }

    /**
     * @param string $title
     * @param string $msg
     * @param $imgLink
     * @param $categoriesId
     * @return bool
     */
    public function CreatePost(string $title, string $msg,$imgLink,$categoriesId): bool{
        $query = 'INSERT INTO POST 
        (ID_AUTHOR, PARENT_ID, TITLE, TEXT_CONTENT, ATTACHED_PICTURE, SEND_DATE, LAST_EDIT_DATE) 
        VALUES (?, NULL, ?, ?, ?, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)';
        $request = Database::getInstance()->prepare($query);
        try {
            $request->execute([$this->id, $title, $msg, $imgLink]);
            $post_id = Database::getInstance()->query('SELECT ID_POST FROM POST WHERE ID_POST=LAST_INSERT_ID()')->fetch()['ID_POST'];
            foreach ($categoriesId as $cat) {
                $reqCatPost = 'INSERT INTO POSTS_CATEGORY (ID_CATEGORY,ID_POST) VALUES (?, ?)';
                $requestCatPOST = Database::getInstance()->prepare($reqCatPost);
                $requestCatPOST->execute([$cat, $post_id]);
            }
            return true;
        }
        catch(\PDOException $exception) {return false;}
    }

    /**
     * @param $msg
     * @param $parent_id
     * @return bool
     */
    public function CreateComment($msg,$imgLink,$parent_id) : bool{
//        return false;
        $query = 'INSERT INTO POST 
        (ID_AUTHOR, PARENT_ID, TITLE, TEXT_CONTENT, ATTACHED_PICTURE, SEND_DATE, LAST_EDIT_DATE) 
        VALUES (?, ?, NULL, ?, ?, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)';
        $request = Database::getInstance()->prepare($query);
        try {
            $request->execute([$this->id, $parent_id, $msg, $imgLink]);
            return true;
        }
        catch(\PDOException $exception) {return false;}
    }

    public function ModifyUsername(string $NewUsername) : void{
        $this->username = $NewUsername;
        $query = 'UPDATE YUTA_USER SET USERNAME = ? WHERE ID_USER = ?';
        $request = Database::getInstance()->prepare($query);
        $request->execute([$NewUsername, $this->id]);
    }
    public function ModifyPfp($NewImage) : void{
        $upload_data = imageUploader::uploadPicture($NewImage['tmp_name'],$NewImage['size']);
        if($upload_data){
            $imgLink = $upload_data->data->link;
        } else {
            $imgLink = null;
        }
        $this->profile_picture = $imgLink;
        $query = 'UPDATE YUTA_USER SET PROFILE_PICTURE = ? WHERE ID_USER = ?';
        $request = Database::getInstance()->prepare($query);
        $request->execute([$imgLink, $this->id]);
    }

    public function LikePost(int $IDPost){
        $query = 'INSERT INTO LIKE_TABLE (LIKED_POST, USER_ID, LIKE_DATE)
                VALUES (? , ?, CURRENT_TIMESTAMP)';
        $request = Database::getInstance()->prepare($query);
        $request->execute([$IDPost,$this->id]);
    }
    public function UnlikePost(int $IDPost){
        $query = 'DELETE FROM LIKE_TABLE WHERE LIKED_POST = ? AND USER_ID = ?';
        $request = Database::getInstance()->prepare($query);
        $request->execute([$IDPost,$this->id]);
    }
}