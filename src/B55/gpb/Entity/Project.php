<?php
namespace B55\gpb\Entity;

class Project
{
    protected $title;
    protected $description;
    protected $last_update;
    protected $url;

    public function __construct($github_repo) {
        $this->title = $github_repo['name'];
        $this->url = $github_repo['homepage'] ?
            $github_repo['homepage'] : $github_repo['html_url'] ;
        $this->description = $github_repo['description'];
        $this->last_update = $github_repo['updated_at'];
    }

    public function __toString() {
        return "repo: " . $this->title . ', last updated: ' . $this->last_update;
    }
}
