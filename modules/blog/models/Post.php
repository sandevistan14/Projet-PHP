<?php

namespace modules\blog\models;

use Cassandra\Date;
use DateTime;

class Post
{
    private int $IdPost;
    private User $Author;
    private string $Title;
    private string $Text;
    private string $Picture;
    private DateTime $sendDate;
    private DateTime $lastEditDate;

    public function __construct(int    $ID, User $author, string $title, string $text, string $picture,string $sendDatedate,
                                string $lasteditdate){
        $this->IdPost = $ID;
        $this->Author = $author;
        $this->Text = $text;
        $this->Picture = $picture;
        $this->Title = $title;
        $this->sendDate = DateTime::createFromFormat( "Y-m-d H:i:s",$sendDatedate,
            new \DateTimeZone('Europe/Berlin'));
        $this->lastEditDate = DateTime::createFromFormat( "Y-m-d H:i:s",$lasteditdate,
            new \DateTimeZone('Europe/Berlin'));
    }

    public function isAdmin(): bool
    {
        return true;
    }

    public function showPost(){

    }

    public function getIdPost(): int
    {
        return $this->IdPost;
    }

    public function setIdPost(int $IdPost): void
    {
        $this->IdPost = $IdPost;
    }

    public function getAuthor(): User
    {
        return $this->Author;
    }

    public function setAuthor(User $Author): void
    {
        $this->Author = $Author;
    }

    public function getTitle(): string
    {
        return $this->Title;
    }

    public function setTitle(string $Title): void
    {
        $this->Title = $Title;
    }

    public function getText(): string
    {
        return $this->Text;
    }

    public function setText(string $Text): void
    {
        $this->Text = $Text;
    }

    public function getPicture(): string
    {
        return $this->Picture;
    }

    public function setPicture(string $Picture): void
    {
        $this->Picture = $Picture;
    }

    public function getSendDate(): DateTime
    {
        return $this->sendDate;
    }

    public function setSendDate(DateTime $sendDate): void
    {
        $this->sendDate = $sendDate;
    }

    public function getLastEditDate(): DateTime
    {
        return $this->lastEditDate;
    }

    public function setLastEditDate(DateTime $lastEditDate): void
    {
        $this->lastEditDate = $lastEditDate;
    }
    
}