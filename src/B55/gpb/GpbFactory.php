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
                    $github_repo = $githubApi->api('repo')->show(
                        $user_name,
                        $projects[$j]
                    );
                    $repo = $user->createRepo($github_repo);
                    $repo->setNbOpenIssues($github_repo['open_issues']);

                    $contributors = $githubApi->api('repo')->contributors(
                        $user_name,
                        $projects[$j]
                    );
                    $repo->setNbContribs(count($contributors));

                    $commits = $githubApi->api('repo')
                        ->commits()
                        ->all($user_name, $projects[$j], array('sha' => 'master'));
                    if (count($commits)) {
                        $repo->setLastsCommits($commits, 5);
                        $repo->setNbCommits(count($commits));
                    }

                    $tags = $githubApi->api('repo')->tags($user_name, $projects[$j]);
                    if (count($tags)) {
                        $repo->setTags($tags);
                    }

                    $branches = $githubApi->api('repo')
                        ->branches($user_name, $projects[$j]);
                    if (count($branches)) {
                        $repo->setBranches($branches);
                    }

                    $tags = $githubApi->api('repo')->tags($user_name, $projects[$j]);
                    if (count($tags)) {
                        $repo->setTags($tags);
                    }

                    if ($github_repo['has_issues']) {
                        $issues = $githubApi->api('issue')
                            ->all($user_name, $projects[$j], array('state' => 'open'));

                        if (count($issues)) {
                            $repo->setIssues($issues);
                        }
                    }
                }
            }
        }
        return $dashboard;
    }
}
