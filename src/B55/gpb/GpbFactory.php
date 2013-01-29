<?php
namespace B55\gpb;

use B55\gpb\Entity\Dashboard;

class GpbFactory
{
    public function __construct(Array $config = array(), $githubApi) {
        echo '<pre>';
        $users = $config['users'];
        $dashboard = new Dashboard();
        for ($i = 0, $nb = count($users); $i < $nb; ++$i) {
            foreach ($users[$i] as $user_name => $projects) {
                $github_user = $githubApi->api('user')->show($user_name);
                $user = $dashboard->createUser($github_user);
                echo $user . '<br>';
                for ($j = 0, $nb2 = count($projects); $j < $nb2; ++$j) {
                    $github_repo = $githubApi->api('repo')->show($user_name, $projects[$j]);
                    $repo = $user->createRepo($github_repo);
                    echo $repo . '<br />';
                }
            }
        }
        die;

    }
}
