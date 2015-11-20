<?php

class ApiModule extends CWebModule
{
    public $version = '0.1';
    public $name;
    
    /**
     * Возвращаем версию:
     *
     * @return string
     **/
    public function getVersion()
    {        
        return $this->version;
    }
    
    /**
     * Возвращаем редактируемые параметры:     
     **/
    public function getEditableParams()
    {
        return array(
            
        );
    }   

    /**
     * Возвращаем название модуля:     
     **/
    public function getName()
    {
        return $this->name;
    }

    /**
     * Возвращаем описание модуля:     
     **/
    public function getDescription()
    {
        return Yii::t('ApiModule.description', 'Api module for books');
    }   

    /**
     * Инициализация модуля:
     *
     * @return nothing
     **/
    public function init()
    {
        parent::init();   
        
        $this->setImport(            
            array(
                'api.models.*',
                'api.components.*',
            )            
        );
    }
	
}
