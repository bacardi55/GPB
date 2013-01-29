<?php
namespace B55\gpb\GithubApi;

interface GithubApiInterface
{
    public function getUserFromGithub($user_name);
    public function getProjectFromGithub();
}
