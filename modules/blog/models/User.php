<?php

namespace modules\blog\models;

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

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getMailAddress(): string
    {
        return $this->mail_address;
    }

    public function setMailAddress(string $mail_address): void
    {
        $this->mail_address = $mail_address;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getProfilePicture(): string
    {
        return $this->profile_picture;
    }

    public function setProfilePicture(string $profile_picture): void
    {
        $this->profile_picture = $profile_picture;
    }

    public function getFirstLogin(): DateTime
    {
        return $this->first_login;
    }

    public function setFirstLogin(DateTime $first_login): void
    {
        $this->first_login = $first_login;
    }

    public function getLastLogin(): DateTime
    {
        return $this->last_login;
    }

    public function setLastLogin(DateTime $last_login): void
    {
        $this->last_login = $last_login;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function setActive(bool $active): void
    {
        $this->active = $active;
    }

    public function getVerificationCode(): string
    {
        return $this->verification_code;
    }

    public function setVerificationCode(string $verification_code): void
    {
        $this->verification_code = $verification_code;
    }

    public function isAdmin(): bool
    {
        return false;
    }

    public function sendVerificationCode(): bool
    {
        $subject = 'Votre code de vérification YUTA';
        $message = 'Votre code de vérification est :'.$this->verification_code.'.';
        $headers = "From: yuta@yutaa.com";
        return mail($this->getMailAddress(), $subject, $message, $headers);
    }

    public function CreatePost(string $title, string $msg): void{}

    public function CreateComment($msg, $billet) : void{}
}