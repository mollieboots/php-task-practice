<?php
    class Task
    {
        private $desc;

        function __construct($desc)
        {
            $this->desc = $desc;
        }

        function getDesc()
        {
            return $this->desc;
        }

        function setDesc($desc)
        {
            $this->desc = $desc;
        }

        function save()
        {
            array_push($_SESSION['task-list'], $this);
        }

        static function getAll()
        {
            return $_SESSION['task-list'];
        }
    }
?>
