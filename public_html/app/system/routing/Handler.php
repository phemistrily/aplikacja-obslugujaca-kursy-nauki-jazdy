<?php
abstract class Handler
{
    /**
     * controller('controller_name')
     */
    public function controller($controller) 
    {
        require_once 'app/source/controllers/BaseController.php';
        require_once 'app/source/controllers/'.$controller.'Controller.php';
    }
}
?>