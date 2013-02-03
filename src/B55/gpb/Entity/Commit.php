<?php
namespace B55\gpb\Entity;

class Commit
{
    protected $url;
    protected $message;
    protected $author;

    public function __construct($github_commits) {
        $this->url = $github_commits['commit']['url'];
        $this->message = $github_commits['commit']['message'];
        $this->author = $github_commits['commit']['author']['name'];
    }

    public function getUrl() {
        return $this->url;
    }

    public function getMessage() {
        if (strlen($this->message) > 55) {
          return substr($this->message, 0, 50) . ' …';
        } else {
          return $this->message;
        }
    }

    public function getAuthor() {
        return $this->author;
    }
}
