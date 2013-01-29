<?php
namespace B55\gpb\Entity;

class Dashboard
{
    protected $title;
    protected $subtitle;
    protected $users;

    public function __construct($title, $subtitle = '') {
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->users = array();
    }

    public function getTitle() {
        return $this->title;
    }

    public function getsubtitle() {
        return $this->subtitle;
    }

    public function getUsers() {
        return $this->users;
    }

    public function createUser($github_user) {
        $user = new User($github_user);
        $this->users[] = $user;

        return $user;
    }
}
