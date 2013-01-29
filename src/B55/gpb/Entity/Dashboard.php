<?php
namespace B55\gpb\Entity;

class Dashboard
{
    protected $users;

    public function __construct() {
        $this->users = array();
    }

    public function createUser($github_user) {
        $user = new User($github_user);
        $this->users[] = $user;

        return $user;
    }
}
