<?php
namespace B55\gpb\Entity;

class Issue
{
    protected $title;
    protected $user;
    protected $body;
    protected $url;

    public function __construct($title, $user, $body, $url) {
        $this->title = $title;
        $this->user = $user;
        $this->body = $body;
        $this->url = $url;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getUser() {
        return $this->user;
    }

    public function getBody() {
        return $this->body;
    }

    public function getUrl() {
        return $this->url;
    }
}
