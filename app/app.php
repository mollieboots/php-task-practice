<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Task.php";

    session_start();
    if(empty($_SESSION['task-list']))
    {
        $_SESSION['task-list'] = array();
    }

    $app = new Silex\Application();

    $app->get("/", function(){

        $output = "";

        foreach (Task::getAll() as $task) {
            $output = $output . "<li>" . $task->getDesc() . "</li>";
        }

        return $output . "<form action='/taskAdded' method='post'><label for='desc'>Enter a new task</label><input name='desc' id='desc'><button type='submit'>Submit</button>";
    });

    $app->post("/taskAdded", function(){
        $task = new Task($_POST['desc']);
        $task->save();
        $thisTask = $task->getDesc();
        $output = "<h1>New task added!</h1><div>Your task: $thisTask</div><a href='/'>Go To List</a>";

        return $output;
    });

    return $app;
?>
