<?php

class LoginProfessor extends PHPFrodo
{

    public $message_login;

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
        $this->tpl( 'public/professor_login.html' );
        $this->proccess();
        $this->assign( 'message_login', "$this->message_login" );
        $this->render();
    }

    public function proccess()
    {
        if ( isset( $_POST['professor_login'] ) && isset( $_POST['professor_senha'] ) && !empty( $_POST['professor_login'] ) && !empty( $_POST['professor_senha'] ) )
        {
            $professor_login = trim( $_POST['professor_login'] );
            $professor_senha = md5( trim( $_POST['professor_senha'] ) );
            $this->select( '*' )
                    ->from( 'professor' )
                    ->where( "professor_login = '$professor_login' and professor_senha = '$professor_senha'" )
                    ->execute();
            if ( $this->result() )
            {
                $sid = new Session;
                $sid->start();
                $sid->init( 936000 );
                $sid->addNode( 'start', date( 'd/m/Y - h:i' ) );
                $sid->addNode( 'professor_id', $this->data[0]['professor_id'] );
                $sid->addNode( 'professor_login', $this->data[0]['professor_login'] );
                $sid->addNode( 'professor_nome', $this->data[0]['professor_nome'] );
                $sid->check();
                $this->redirect( "$this->baseUri/professor/" );
            }
            else
            {
                $this->message_login = "$('#form-login').popover({'trigger':'manual','placement':'right','title': 'Aten��o:','content':'Login ou Senha incorretos!'});";
                $this->message_login .= "$('#form-login').popover('show');";
            }
        }
        else
        {
            $this->message_login = "$('#form-login').popover({'trigger':'manual','placement':'right','title': 'Aten��o:','content':'Login / Senha requeridos!'});";
            $this->message_login .= "$('#form-login').popover('show');";
            $this->message_login = "";
        }
    }

    public function logout()
    {
        $sid = new Session;
        @$sid->start();
        $sid->destroy();
        $this->redirect( "$this->baseUri/" );
    }

    public function repass()
    {
        if ( $this->postIsValid( array( 'professor_email' => 'string' ) ) )
        {
            $professor_email = $this->postGetValue( 'professor_email' );
            $chars = 'abcdefghijlmnopqrstuvxwzABCDEFGHIJLMNOPQRSTUVXYWZ0123456789';
            $max = strlen( $chars ) - 1;
            $pass = "";
            $width = 8;
            for ( $i = 0; $i < $width; $i++ )
            {
                $pass .= $chars{mt_rand( 0, $max )};
            }
            $this->select( '*' )
                    ->from( 'professor' )
                    ->where( "professor_email = '$professor_email'" )
                    ->execute();
            if ( !$this->result() )
            {
                $this->tpl( 'public/professor_login.html' );
                $this->message_login = "$('#form-login').hide();$('#form-login-repass').show();";
                $this->message_login .= "$('#form-login-repass').popover({'trigger':'manual', 'placement':'right', 'title': 'Recupera��o de senha:', 'content':'E-mail informado n�o cadastrado!'});";
                $this->message_login .= "$('#form-login-repass').popover('show');";
                $this->assign( 'message_login', "$this->message_login" );
                $this->render();
                exit;
            }

            $this->update( 'professor' )
                    ->set( array( 'professor_senha' ), array( md5( $pass ) ) )
                    ->where( "professor_email = '$professor_email'" );
            if ( $this->execute() )
            {
                if ( $this->result() )
                {
                    extract( $this->data[0] );
                }
                $site_title = $this->config->config_site_title;
                $bodyMail = "<h3>Recupera��o de senha | $site_title</h3>";
                $bodyMail .= "<h3>Sua nova senha: $pass</h3>";
                $this->helper( 'mail' );
                global $mail;
                ///recupera dados de login da conta
                $this->select()->from( 'smtp' )->execute();
                if ( $this->result() )
                {
                    $m = ( object ) $this->data[0];
                    $mail->Port = $m->smtp_port;
                    $mail->Host = "$m->smtp_host";
                    $mail->Username = $m->smtp_username;
                    $mail->Password = $m->smtp_password;
                    $mail->From = $m->smtp_username;
                    $mail->FromName = $m->smtp_fromname;
                }
                $mail->AddAddress( "$professor_email" );
                $mail->Subject = "$site_title | Recupera��o de senha";
                $mail->Body = $bodyMail;

                if ( $mail->Send() )
                {
                    $this->tpl( 'public/professor_login.html' );
                    $this->message_login = "$('#form-login').show();$('#form-login-repass').hide();";
                    $this->message_login .= "$('#form-login #professor_senha').popover({'trigger':'manual', 'placement':'right', 'title': 'Recupera��o de senha:', 'content':'Sua nova senha foi enviada por e-mail!'});";
                    $this->message_login .= "$('#form-login #professor_senha').popover('show');$('#professor_email').val(\"$professor_email\");";
                    $this->assign( 'message_login', "$this->message_login" );
                    $this->render();
                    exit;
                }
                else
                {
                    $this->tpl( 'public/professor_login.html' );
                    $this->message_login = "$('#form-login').hide();$('#form-login-repass').show();";
                    $this->message_login .= "$('#form-login-repass').popover({'trigger':'manual', 'placement':'right', 'title': 'Recupera��o de senha:', 'content':'Houve um erro ao enviar o e-mail! Entre em contato com suporte!'});";
                    $this->message_login .= "$('#form-login-repass').popover('show');";
                    $this->assign( 'message_login', "$this->message_login" );
                    $this->render();
                    exit;
                }
            }
            else
            {
                $this->tpl( 'public/professor_login.html' );
                $this->message_login = "$('#form-login').hide();$('#form-login-repass').show();";
                $this->message_login .= "$('#form-login-repass').popover({'trigger':'manual', 'placement':'right', 'title': 'Recupera��o de senha:', 'content':'Houve um erro ao alterar a senha! Entre em contato com suporte!'});";
                $this->message_login .= "$('#form-login-repass').popover('show');";
                $this->assign( 'message_login', "$this->message_login" );
                $this->render();
                exit;
            }
        }
        else
        {
            $this->tpl( 'public/professor_login.html' );
                $this->message_login = "$('#form-login').hide();$('#form-login-repass').show();";
                $this->message_login .= "$('#form-login-repass').popover({'trigger':'manual', 'placement':'right', 'title': 'Recupera��o de senha:', 'content':'E-mail informado n�o cadastrado!'});";
                $this->message_login .= "$('#form-login-repass').popover('show');";
            $this->assign( 'message_login', "$this->message_login" );
            $this->render();
            exit;
        }
    }

}

/* end file */