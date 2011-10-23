<?php

class MetaTagSubForm extends SubForm
{
    public $model;
    public $title = "Мета-теги";

    public function init()
    {
        $class     = 'application.components.activeRecordBehaviors.MetaTagBehavior';

        $behaviors = $this->model->behaviors();
        $classes   = ArrayHelper::extract($behaviors, 'class');
        if (!in_array($class, $classes))
        {
            throw new CException("Модель должна иметь поведение: {$class}");
        }

        if (!isset($this->model->meta_tags))
        {
            throw new CException("Класс {$class} должен иметь поле meta_tags");
        }

        parent::init();
    }


    public function renderContent()
    {
        $model = MetaTag::model();

        $meta_tags = MetaTag::model()->findAllByAttributes(array(
            'object_id' => $this->model->id,
            'model_id'  => get_class($this->model)
        ));
//
//        if (isset($_POST[get_class($this->model)]['meta_tags']))
//        {
//            foreach ($_POST[get_class($this->model)]['meta_tags'] as $tag => $value)
//            {
//                $model->$tag = $value;
//            }
//        }
//        
        $this->render('MetaTagSubForm', array(
            'meta_tags' => $meta_tags
        ));

    }
}
