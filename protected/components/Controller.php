<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{	       
        public function __construct($id, $module = null)
        {          
            parent::__construct($id, $module);            
        }
        
}