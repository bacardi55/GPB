<?php
namespace B55\gpb;

use B55\gpb\Entity\Dashboard;

class GpbFactory
{
    public function __construct() {
    }

    public function createDashboard($config, $githubApi) {
        $users = $config['users'];
        $subtitle = array_key_exists('subtitle', $config) ? $config['subtitle'] : '' ;
        $dashboard = new Dashboard($config['title'], $subtitle);
        for ($i = 0, $nb = count($users); $i < $nb; ++$i) {
            foreach ($users[$i] as $user_name => $projects) {
                $github_user = $githubApi->api('user')->show($user_name);
                $user = $dashboard->createUser($github_user);
                for ($j = 0, $nb2 = count($projects); $j < $nb2; ++$j) {
                    $github_repo = $githubApi->api('repo')->show($user_name, $projects[$j]);
                    $repo = $user->createRepo($github_repo);
                }
            }
        }
        return $dashboard;
    }
}
