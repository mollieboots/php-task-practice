<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Task.php";

    session_start();
    if(empty($_SESSION['task-list']))
    {
        $_SESSION['task-list'] = array();
    }

    $app = new Silex\Application();

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views'
    ));

    $app->get("/", function() use ($app){
        return $app['twig']->render('tasks.html.twig', array('tasks' => Task::getAll()));
    });

    $app->post("/taskadded", function() use ($app){
        $task = new Task($_POST['desc']);
        $task->save();
        return $app['twig']->render('taskadded.html.twig', array('newtask' => $task));
    });

    $app->post("/taskdeleted", function() use ($app) {
        Task::deleteAll();
        return $app['twig']->render('taskdeleted.html.twig');
    });

    return $app;
?>
