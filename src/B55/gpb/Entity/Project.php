<?php
namespace B55\gpb\Entity;

class Project
{
    protected $title;
    protected $description;
    protected $lastUpdate;
    protected $url;

    public function __construct($github_repo) {
        $this->title = $github_repo['name'];
        $this->url = $github_repo['homepage'] ?
            $github_repo['homepage'] : $github_repo['html_url'] ;
        $this->description = $github_repo['description'];
        $this->lastUpdate = $github_repo['updated_at'];
    }

    public function getTitle() {
        return $this->title;
    }

    public function getUrl() {
        return $this->url;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getLastUpdate() {
        return $this->lastUpdate;
    }

    public function __toString() {
        return "repo: " . $this->title . ', last updated: ' . $this->lastUpdate;
    }
}
