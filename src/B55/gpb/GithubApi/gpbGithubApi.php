<?php
namespace B55\gpb\GithubApi;

use Buzz\Browser as Browser;

class gpbGithubApi implements GithubApiInterface
{
    public function getUserFromGithub($user_name) {
        $browser = new Browser();
        $response = $browser->get('http://google.fr');
        echo $response;
    }

    public function getProjectFromGithub() {

    }
}
