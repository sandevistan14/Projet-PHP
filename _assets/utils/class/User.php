<?php

namespace Utils\Class;

use DateTime;

class User
{
    private int $id;

    private bool $admin_status;

    private string $mail_address;

    private string $username;

    private string $password;

    private string $profile_picture;

    private DateTime $first_login;

    private DateTime $last_login;

    private bool $active;

    private string $verification_code;

    public function __construct(int $id, bool $admin_status, string $mail_address, string $username, string $password, string|null $profile_picture, string $first_login, string $last_login, bool $active, string $verification_code)
    {
        $this->id = $id;
        $this->admin_status = $admin_status;
        $this->mail_address = $mail_address;
        $this->username = $username;
        $this->password = $password;
        $this->profile_picture = $profile_picture ?? 'null';
        $this->first_login = DateTime::createFromFormat( "Y-m-d H:i:s",$first_login,
            new \DateTimeZone('Europe/Berlin'));
        $this->last_login = DateTime::createFromFormat( "Y-m-d H:i:s",$last_login,
            new \DateTimeZone('Europe/Berlin'));
        $this->active = $active;
        $this->verification_code = $verification_code;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function isAdminStatus(): bool
    {
        return $this->admin_status;
    }

    public function setAdminStatus(bool $admin_status): void
    {
        $this->admin_status = $admin_status;
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

    public function CreatePost(string $title, string $msg): void{}

    public function CreateComment($msg, $billet) : void{}
}