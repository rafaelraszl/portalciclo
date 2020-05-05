<?php

//        setlocale(LC_ALL, 'pt_BR','ptb'); 
//        echo ucfirst(gmstrftime("%B")); 
		
class Index extends PHPFrodo
{

    private $user_login;
    private $user_id;
    private $user_name;

    public function __construct()
    {
        parent::__construct();
        $sid = new Session;
        $sid->start();
        if ( !$sid->check() || $sid->getNode( 'user_id' ) <= 0 )
        {
            $this->redirect( "$this->baseUri/admin/login/logout/" );
            exit;
        }           
        setlocale(LC_ALL, 'pt_BR','ptb'); 
        $this->assign( 'mesExtenso', ucfirst(gmstrftime("%B")));
        
        $this->user_login = $sid->getNode( 'user_login' );
        $this->user_id = $sid->getNode( 'user_id' );
        $this->user_name = $sid->getNode( 'user_name' );
        $this->assign( 'user_name', $this->user_name );
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
        //$this->redirect( "$this->baseUri/admin/dashboard/pedidos/" );
        $this->tpl( 'admin/dashboard.html' );
        setlocale(LC_ALL, 'pt_BR','ptb'); 
        $this->assign( 'mesExtenso', ucfirst(gmstrftime("%B"))); 		
        $this->render();
    }

}

/*end file*/
