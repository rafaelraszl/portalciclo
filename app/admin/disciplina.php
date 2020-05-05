<?php

class Disciplina extends PHPFrodo
{

    public $user_login;
    public $user_id;
    public $user_name;
    public $msgError;
    public $disciplina_id;
    public $sub_id;
    public $sub_title;
    public $item_id;
    public $item_title;
    public $disciplina_nome;

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
        if ( isset( $this->uri_segment ) && in_array('process-ok',$this->uri_segment) )
        {
            $this->assign( 'msgOnload', 'notify("<h1>Procedimento realizado com sucesso</h1>")' );
        }
        setlocale(LC_ALL, 'pt_BR','ptb'); 
        $this->assign( 'mesExtenso', ucfirst(gmstrftime("%B")));        
    }

    public function welcome()
    {
        $this->pagebase = "$this->baseUri/admin/disciplina";
        $this->tpl( 'admin/disciplina.html' );
        $this->select()
                ->from( 'disciplina' )
                ->paginate( 15 )
                ->orderby( 'disciplina_nome asc' )
                ->execute();
        if ( $this->result() )
        {
            $this->fetch( 'rs', $this->data );
            $this->assign( 'disciplina_qtde', count( $this->data ) );
        }
        $this->render();
    }

    public function incluir()
    {
        if ( $this->postIsValid( array( 'disciplina_nome' => 'string' ) ) )
        {
            $this->postValueChange( 'disciplina_nome', ucfirst( $this->postGetValue( 'disciplina_nome' ) ) );
            $this->insert( 'disciplina' )->fields()->values()->execute();
            $this->redirect( "$this->baseUri/admin/disciplina/process-ok/" );
        }
        else
        {
            $this->msgError = $this->response;
            $this->pageError();
        }
    }

    public function atualizar()
    {
        if ( isset( $this->uri_segment[2] ) )
        {
            if ( $this->postIsValid( array( 'disciplina_nome' => 'string' ) ) )
            {
                $this->disciplina_id = $this->uri_segment[2];
                $this->postValueChange( 'disciplina_nome', ucfirst( $this->postGetValue( 'disciplina_nome' ) ) );
                $this->update( 'disciplina' )->set()->where( "disciplina_id = $this->disciplina_id" )->execute();
                $this->redirect( "$this->baseUri/admin/disciplina/process-ok/" );
            }
        }
    }

    public function remover()
    {
        if ( isset( $this->uri_segment[2] ) )
        {
            $this->disciplina_id = $this->uri_segment[2];
            //if ( $this->removeSub() ){
                $this->delete()->from( 'disciplina' )->where( "disciplina_id = $this->disciplina_id" )->execute();
                $this->redirect( "$this->baseUri/admin/disciplina/process-ok/" );
            //}
        }
    }

    public function removeSub()
    {
        $this->select()
                ->from( 'sub' )
                ->where( "sub_disciplina = $this->disciplina_id" )
                ->execute();
        if ( $this->result() )
        {
            $subData = $this->data;
            foreach ( $subData as $sub )
            {
                $sub = ( object ) $sub;
                $this->sub_id = $sub->sub_id;
                $this->select()
                        ->from( 'cliente' )
                        ->where( "cliente_sub = $this->sub_id" )
                        ->execute();
                if ( $this->result() )
                {
                    $itemData = $this->data;
                    foreach ( $itemData as $item )
                    {
                        $item = ( object ) $item;
                        $this->cliente_id = $item->cliente_id;
                    }
                }
            }
        }
        return true;
    }

    public function pageError()
    {
        $this->tpl( 'admin/error.html' );
        $this->assign( 'msgError', $this->msgError );
        $this->render();
    }

}

/*end file*/