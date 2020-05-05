<?php

class Professor extends PHPFrodo
{

    public $user_login;
    public $user_id;
    public $user_name;
    public $msgError;
    public $professor_id;
    public $professor_nome;
    public $professor_senha;
    public $disciplina_id;
    public $disciplina_nome;
    public $item_id;
    public $item_title;

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
        if ( isset( $this->uri_segment ) && in_array( 'process-ok', $this->uri_segment ) )
        {
            $this->assign( 'msgOnload', 'notify("<h1>Procedimento realizado com sucesso</h1>")' );
        }
        setlocale( LC_ALL, 'pt_BR', 'ptb' );
        $this->assign( 'mesExtenso', ucfirst( gmstrftime( "%B" ) ) );
    }

    public function welcome()
    {
        $this->pagebase = "$this->baseUri/admin/professor";
        $this->tpl( 'admin/professor.html' );
        $this->select()
                ->from( 'professor' )
                //->join( 'categoria', 'sub_categoria = categoria_id', 'INNER' )
                ->paginate( 15 )
                ->orderby( 'professor_nome asc' )
                ->execute();
        if ( $this->result() )
        {
            $this->fetch( 'rs', $this->data );
            $this->assign( 'sub_qtde', count( $this->data ) );
        }
        $this->render();
    }

    public function incluir()
    {
        if ( $this->postIsValid( array( 'professor_nome' => 'string' ) ) )
        {
            $this->postValueChange( 'professor_nome', ucfirst( $this->postGetValue( 'professor_nome' ) ) );
            $this->postValueChange( 'professor_senha', md5( $this->postGetValue( 'professor_senha' ) ) );
            $this->insert( 'professor' )->fields()->values()->execute();
            $this->redirect( "$this->baseUri/admin/professor/process-ok/" );
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
            if ( $this->postIsValid( array( 'professor_nome' => 'string' ) ) )
            {
                $this->professor_id = $this->uri_segment[2];
                $this->postValueChange( 'professor_nome', ucfirst( $this->postGetValue( 'professor_nome' ) ) );
                $this->professor_senha = trim( $this->postGetValue( 'professor_senha' ) );
                if ( $this->professor_senha == "" )
                {
                    $this->postIndexDrop( 'professor_senha' );
                }
                else
                {
                    $this->postValueChange( 'professor_senha', md5( $this->professor_senha ) );
                }
                $this->update( 'professor' )->set()->where( "professor_id = $this->professor_id" )->execute();
                $this->redirect( "$this->baseUri/admin/professor/process-ok/" );
            }
        }
    }

    public function remover()
    {
        if ( isset( $this->uri_segment[2] ) )
        {
            $this->professor_id = $this->uri_segment[2];
            $this->delete()->from( 'professor' )->where( "professor_id = $this->professor_id" )->execute();
            $this->redirect( "$this->baseUri/admin/professor/process-ok/" );
        }
    }

    public function pageError()
    {
        $this->tpl( 'admin/error.html' );
        $this->assign( 'msgError', $this->msgError );
        $this->render();
    }

    public function fillMat()
    {
        $this->select()->from( 'disciplina' )->orderby( 'disciplina_nome' )->execute();
        if ( $this->result() )
        {
            $this->fetch( 'm', $this->data );
        }
    }

    public function fillSub()
    {
        $this->select()
                ->from( 'sub' )
                ->join( 'categoria', 'categoria_id = sub_categoria', 'INNER' )
                ->orderby( 'sub_title' )->execute();
        if ( $this->result() )
        {
            $this->fetch( 'm', $this->data );
        }
    }

    public function fillProf()
    {
        $this->select()->from( 'professor' )->orderby( 'professor_nome' )->execute();
        if ( $this->result() )
        {
            $this->fetch( 'p', $this->data );
        }
    }

    public function vincular()
    {
        $this->pagebase = "$this->baseUri/admin/professor/vincular";
        $this->tpl( 'admin/professor_disciplina.html' );

        $this->fillProf();
        $this->fillMat();

        $this->select()
                ->from( 'profmat' )
                ->join( 'professor', 'professor_id = profmat_prof', 'INNER' )
                ->join( 'disciplina', 'disciplina_id = profmat_mat', 'INNER' )
                //->paginate( 15 )
                ->orderby( 'professor_nome asc' )
                ->execute();
        if ( $this->result() )
        {
            $this->fetch( 'rs', $this->data );
            $this->assign( 'sub_qtde', count( $this->data ) );
        }
        $this->render();
    }

    public function vincularAdd()
    {
        if ( $this->postIsValid( array( 'profmat_prof' => 'string' ) ) )
        {
            $this->insert( 'profmat' )->fields()->values()->execute();
            $this->redirect( "$this->baseUri/admin/professor/vincular/process-ok/" );
        }
    }

    public function vincularRem()
    {
        if ( isset( $this->uri_segment[2] ) )
        {
            $this->profmat_id = $this->uri_segment[2];
            $this->delete()->from( 'profmat' )->where( "profmat_id = $this->profmat_id" )->execute();
            $this->redirect( "$this->baseUri/admin/professor/vincular/process-ok/" );
        }
    }

    public function vincularUp()
    {
        if ( isset( $this->uri_segment[2] ) )
        {
            if ( $this->postIsValid( array( 'profmat_prof' => 'string' ) ) )
            {
                $this->profmat_id = $this->uri_segment[2];
                $this->update( 'profmat' )->set()->where( "profmat_id = $this->profmat_id" )->execute();
                $this->redirect( "$this->baseUri/admin/professor/vincular/process-ok/" );
            }
        }
    }

    public function vincularS()
    {
        $this->pagebase = "$this->baseUri/admin/professor/vincularS";
        $this->tpl( 'admin/professor_serie.html' );

        $this->fillProf();
        $this->fillSub();

        $this->select()
                ->from( 'profserie' )
                ->join( 'professor', 'professor_id = profserie_prof', 'INNER' )
                ->join( 'sub', 'sub_id = profserie_sub', 'INNER' )
                //->paginate( 15 )
                ->orderby( 'professor_nome asc' )
                ->execute();
        if ( $this->result() )
        {
            $this->fetch( 'rs', $this->data );
            $this->assign( 'sub_qtde', count( $this->data ) );
        }
        $this->render();
    }

    public function vincularSAdd()
    {
        if ( $this->postIsValid( array( 'profserie_prof' => 'string' ) ) )
        {
            $this->insert( 'profserie' )->fields()->values()->execute();
            $this->redirect( "$this->baseUri/admin/professor/vincularS/process-ok/" );
        }
    }

    public function vincularSRem()
    {
        if ( isset( $this->uri_segment[2] ) )
        {
            $this->profserie_id = $this->uri_segment[2];
            $this->delete()->from( 'profserie' )->where( "profserie_id = $this->profserie_id" )->execute();            
            $this->redirect( "$this->baseUri/admin/professor/vincularS/process-ok/" );
        }
    }

    public function vincularSUp()
    {
        if ( isset( $this->uri_segment[2] ) )
        {
            if ( $this->postIsValid( array( 'profserie_prof' => 'string' ) ) )
            {
                $this->profserie_id = $this->uri_segment[2];
                $this->update( 'profserie' )->set()->where( "profserie_id = $this->profserie_id" )->execute();
                $this->redirect( "$this->baseUri/admin/professor/vincularS/process-ok/" );
            }
        }
    }

}

/*END FILE*/