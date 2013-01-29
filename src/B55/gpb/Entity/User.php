<?php
namespace B55\gpb\Entity;

class User
{
    protected $name;
    protected $gravatar;
    protected $respos_url;
    protected $nbRepos;
    protected $blog;
    protected $bio;
    protected $repos;

    public function __construct($github_user) {
        $this->name = $github_user['name'];
        $this->gravatar = $github_user['avatar_url'];
        $this->respos_url = $github_user['repos_url'];
        $this->nbRepos = $github_user['public_repos'];
        $this->blog = $github_user['blog'];
        $this->bio = $github_user['bio'];
        $this->repos = array();
    }

    public function createRepo($github_repo) {
        $project = new Project($github_repo);
        $this->repos[] = $project;
        return $project;
    }

    public function __toString() {
        return 'user: ' . $this->name . ', ' . $this->nbRepos . ' repos';
    }
}
