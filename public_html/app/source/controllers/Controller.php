<?php
abstract class Controller
{
    /**
     * model('model_name')
     */
    public function model($model)
    {
        require_once 'app/source/models/'.$model.'.php';
    }
}

?>