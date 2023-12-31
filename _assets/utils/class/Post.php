<?php

namespace _assets\Utils\Class;

use Cassandra\Date;
use DateTime;
use Utils\Class\User;

class Post
{
    private int $IdPost;
    private User $Author;
    private string $Title;
    private string $Text;
    private DateTime $sendDate;
    private DateTime $lastEditDate;

    public function __construct(int    $ID, User $author, string $title, string $text, string $sendDatedate,
                                string $lasteditdate){
        $this->IdPost = $ID;
        $this->Author = $author;
        $this->Text = $text;
        $this->Title = $title;
        $this->sendDate = DateTime::createFromFormat( "Y-m-d H:i:s",$sendDatedate,
            new \DateTimeZone('Europe/Berlin'));
        $this->lastEditDate = DateTime::createFromFormat( "Y-m-d H:i:s",$lasteditdate,
            new \DateTimeZone('Europe/Berlin'));
    }

    public function showPost(){

    }
}