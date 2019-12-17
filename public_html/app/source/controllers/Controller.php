<?php
abstract class Controller
{
    public static $applicationData = [];
    /**
     * model('model_name')
     */
    public function model($model)
    {
        require_once 'app/source/models/'.$model.'.php';
    }
    
    /**
     * controller('controller_name')
     */
    public function controller($controller) 
    {
        require_once 'app/source/controllers/controller.php';
        require_once 'app/source/controllers/'.$controller.'Controller.php';
    }
}

?>