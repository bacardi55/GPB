<?php
namespace B55\gpb\Controller;

use Silex\Application;
use Silex\ControllerProviderInterface;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Yaml\Yaml;

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
            //echo '<pre>';print_r($config);die;

            $github_api = new $app['gpb.githubApi']();
            $factory = new GpbFactory($config, $github_api);

            return $app['twig']->render('gpb.index.html.twig',
              array(
                'title' => $config['title'],
                'subtitle' => $config['subtitle'],
                //'users' => $users
              )
            );
        })->bind('gpb-homepage');


        return $controllers;
    }
}
