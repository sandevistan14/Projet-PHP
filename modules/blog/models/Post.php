<?php

namespace modules\blog\models;

require '/home/yuta/www/_assets/includes/autoloader.php';

use DateTime;
use _assets\includes\Database;

class Post
{
    private int $IdPost;
    private User $Author;
    private string $title;
    private string $text;
    private string $picture;
    private DateTime $sendDate;
    private DateTime $lastEditDate;
    private int $likesNumber;
    private int $commentsNumber;
    private $categories = array();
    private bool $IsComment;

    public function __construct($post_data,array $categories){
        $this->IdPost = $post_data['ID_POST'];
        $this->Author = \UserRepository::getUserById($post_data['ID_AUTHOR']);
        $this->title = $post_data['TITLE'] ?? '';
        $this->text = $post_data['TEXT_CONTENT'];
        $this->picture = $post_data['ATTACHED_PICTURE'] ?? 'null';
        $this->sendDate = DateTime::createFromFormat( "Y-m-d H:i:s",$post_data['SEND_DATE'],
            new \DateTimeZone('Europe/Berlin'));
        $this->lastEditDate = DateTime::createFromFormat( "Y-m-d H:i:s",$post_data['LAST_EDIT_DATE'],
            new \DateTimeZone('Europe/Berlin'));
        $this->likesNumber = $post_data['LIKE_NUMBER'];
        $this->commentsNumber = $post_data['COMMENT_NUMBER'];
        $this->categories = $categories;
        if ($post_data['PARENT_ID'] === null){
            $this->IsComment = false;
        } else {
            $this->IsComment = true;
        }

    }

    /**
     * @return bool
     */
    public function isAdmin(): bool
    {
        return true;
    }

    /**
     * @return void
     */
    public function showPost(){

    }

    /**
     * @return int
     */
    public function getIdPost(): int
    {
        return $this->IdPost;
    }

    /**
     * @param int $IdPost
     * @return void
     */
    public function setIdPost(int $IdPost): void
    {
        $this->IdPost = $IdPost;
    }

    /**
     * @return User
     */
    public function getAuthor(): User
    {
        return $this->Author;
    }

    /**
     * @param User $Author
     * @return void
     */
    public function setAuthor(User $Author): void
    {
        $this->Author = $Author;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return void
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param string $text
     * @return void
     */
    public function setText(string $text): void
    {
        $this->text = $text;
    }

    /**
     * @return string
     */
    public function getPicture(): string
    {
        return $this->picture;
    }

    /**
     * @param string $picture
     * @return void
     */
    public function setPicture(string $picture): void
    {
        $this->picture = $picture;
    }

    /**
     * @return DateTime
     */
    public function getSendDate(): DateTime
    {
        return $this->sendDate;
    }

    /**
     * @param DateTime $sendDate
     * @return void
     */
    public function setSendDate(DateTime $sendDate): void
    {
        $this->sendDate = $sendDate;
    }

    /**
     * @return DateTime
     */
    public function getLastEditDate(): DateTime
    {
        return $this->lastEditDate;
    }

    /**
     * @param DateTime $lastEditDate
     * @return void
     */
    public function setLastEditDate(DateTime $lastEditDate): void
    {
        $this->lastEditDate = $lastEditDate;
    }

    public function getLikesNumber(): int
    {
        return $this->likesNumber;
    }

    public function setLikesNumber(int $likesNumber): void
    {
        $this->likesNumber = $likesNumber;
    }

    public function getCommentsNumber(): int
    {
        return $this->commentsNumber;
    }

    public function setCommentsNumber(int $commentsNumber): void
    {
        $this->commentsNumber = $commentsNumber;
    }

    /**
     * @return array
     */
    public function getCategories(): array
    {
        return $this->categories;
    }

    /**
     * @param array $categories
     * @return void
     */
    public function setCategories(array $categories): void
    {
        $this->categories = $categories;
    }

    public function isComment(): bool
    {
        return $this->IsComment;
    }

    public function setIsComment(bool $IsComment): void
    {
        $this->IsComment = $IsComment;
    }

    public function IsLike(int $Id_USER):bool {
        $query = 'SELECT * FROM LIKE_TABLE WHERE LIKED_POST = ? AND USER_ID = ?';
        $request = Database::getInstance()->prepare($query);
        $request->execute([$this->IdPost, $Id_USER]);
        if ($request->rowCount() === 0){
            return false;
        }
        else {
            return true;
        }
    }
}