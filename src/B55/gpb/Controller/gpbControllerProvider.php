<?php
namespace B55\gpb\Controller;

use Silex\Application;
use Silex\ControllerProviderInterface;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Yaml\Yaml;

use Github\Client as GithubClient;
use Github\HttpClient as GithubHttpClient;

use B55\gpb\GpbFactory as GpbFactory;

class gpbControllerProvider implements ControllerProviderInterface {
    public function connect(Application $app)
    {
        // creates a new controller based on the default route
        $controllers = $app['controllers_factory'];

        $controllers->match('/', function (Application $app) {
            if (!$app['gpb.config']) {
                return $app->abort(404, 'No config file specified');
            }
            $config = Yaml::parse($app['gpb.config']);
            $config = $config['githubPhpBoard'];

            $github_api = new GithubClient (
              new GithubHttpClient\CachedHttpClient(array('cache_dir' => '/tmp/github-api-cache'))
            );

            $factory = new GpbFactory();
            $date = date('Y-M-d h:i:s');
            $response = new Response($app['twig']->render('gpb.index.html.twig',
              array(
                'dashboard' => $factory->createDashboard($config, $github_api),
                'date' => $date
            )));
            $response->setTtl(900); // TODO
            return $response;
        })->bind('gpb-homepage');


        return $controllers;
    }
}
