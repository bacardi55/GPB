<?php
namespace B55\gpb\Entity;

class Project
{
    protected $title;
    protected $description;
    protected $lastUpdate;
    protected $url;
    protected $commits;
    protected $nbCommits;
    protected $tags;
    protected $branches;
    protected $pullRequest;
    protected $issues;

    public function __construct($github_repo) {
        $this->title = $github_repo['name'];
        $this->url = $github_repo['homepage'] ?
            $github_repo['homepage'] : $github_repo['html_url'] ;

        $this->description = $github_repo['description'];

        $lastUpdate = $github_repo['updated_at'];
        $lastUpdate = explode('T', $lastUpdate);
        $this->lastUpdate = $lastUpdate[0];

        $this->tags = array();
        $this->branches = array();
        $this->issues = array();
        $this->pullRequest = array();
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

    public function setNbCommits($nbCommits) {
        $this->nbCommits = $nbCommits;
    }

    public function getNbCommits() {
        return $this->nbCommits;
    }

    public function setNbContribs($nbContribs) {
        $this->nbContribs = $nbContribs;
    }
    public function getNbContribs() {
        $this->nbContribs;
    }
    public function setLastsCommits($github_commits, $limit = 5) {
        for ($i = 0, $nb = count($github_commits); ($i < $limit && $i < $nb); ++$i) {
            $this->commits[] = new Commit($github_commits[$i]);
        }
    }

    public function getLastsCommits() {
        return $this->commits;
    }

    public function setBranches($github_branches) {
        for ($i = 0, $nb = count($github_branches); $i < $nb; ++$i) {
            $this->branches[] = new Branch(
                $github_branches[$i]['name'],
                $github_branches[$i]['commit']['url']
            );
        }
    }
    public function getBranches() {
        return $this->branches;
    }
    public function getTags() {
        return $this->tags;
    }
    public function setTags($github_tags) {
        for ($i = 0, $nb = count($github_tags); $i < $nb; ++$i) {
          $this->tags[] = new Tag(
              $github_tags[$i]['name'],
              $github_tags[$i]['commit']['url'],
              $github_tags[$i]['tarball_url']
          );
        }
    }
    public function setIssues($github_issues, $limit = 5) {
        for ($i = 0, $nb = count($github_issues); ($i < $nb && $i < $limit); ++$i) {
            $this->issues[] = new Issue(
                $github_issues[$i]['title'],
                $github_issues[$i]['user']['login'],
                $github_issues[$i]['body'],
                $github_issues[$i]['html_url']
            );
        }
    }
    public function getLastIssues($limit = 5) {
        if ($limit === 0 || $limit > count($this->issues)) {
            return $this->issues;
        }

        $tmp = array_slice($this->issues, 0, $limit);
        return $tmp;
    }

    public function setNbOpenIssues($nbOpenIssues) {
        $this->nbOpenIssues = $nbOpenIssues;
    }

    public function __toString() {
        return "repo: " . $this->title . ', last updated: ' . $this->lastUpdate;
    }
}
