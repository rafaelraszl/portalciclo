<?php

class Index extends PHPFrodo
{

    public function __construct()
    {
        parent::__construct();
        $this->select()
                ->from( 'config' )
                ->execute();
        if ( $this->result() )
        {
            $this->config = ( object ) $this->data[0];
            $this->assignAll();
        }        
    }

    public function welcome()
    {
        $this->tpl('public/login.html')->render();
    }

}

/*end file*/