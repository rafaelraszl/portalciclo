<?php

class LoginAluno extends PHPFrodo
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
        $this->tpl( 'public/aluno_login.html' );
        $this->proccess();
        $this->assign( 'message_login', "$this->message_login" );
        $this->render();
    }

    public function proccess()
    {
        if ( isset( $_POST['cliente_matricula'] ) && isset( $_POST['cliente_senha'] ) && !empty( $_POST['cliente_matricula'] ) && !empty( $_POST['cliente_senha'] ) )
        {
            $cliente_matricula = trim( $_POST['cliente_matricula'] );
            $cliente_senha = md5( trim( $_POST['cliente_senha'] ) );
            $this->select( '*' )
                    ->from( 'cliente' )
                    ->where( "cliente_matricula = '$cliente_matricula' and cliente_senha = '$cliente_senha'" )
                    ->execute();
            if ( $this->result() )
            {
                $sid = new Session;
                $sid->start();
                $sid->init( 936000 );
                $sid->addNode( 'start', date( 'd/m/Y - h:i' ) );
                $sid->addNode( 'cliente_id', $this->data[0]['cliente_id'] );
                $sid->addNode( 'cliente_matricula', $this->data[0]['cliente_matricula'] );
                $sid->addNode( 'cliente_nome', $this->data[0]['cliente_nome'] );
                $sid->addNode( 'cliente_sub', $this->data[0]['cliente_sub'] );
                $sid->check();
                $this->redirect( "$this->baseUri/aluno/" );
            }
            else
            {
                $this->message_login = "$('#form-login').popover({'trigger':'manual','placement':'right','title': 'Atenção:','content':'Matrícula ou Senha incorretos!'});";
                $this->message_login .= "$('#form-login').popover('show');";
            }
        }
        else
        {
            $this->message_login = "$('#form-login').popover({'trigger':'manual','placement':'right','title': 'Atenção:','content':'Matrícula / Senha requeridos!'});";
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
        if ( $this->postIsValid( array( 'cliente_email' => 'string' ) ) )
        {
            $cliente_email = $this->postGetValue( 'cliente_email' );
            $chars = 'abcdefghijlmnopqrstuvxwzABCDEFGHIJLMNOPQRSTUVXYWZ0123456789';
            $max = strlen( $chars ) - 1;
            $pass = "";
            $width = 8;
            for ( $i = 0; $i < $width; $i++ )
            {
                $pass .= $chars{mt_rand( 0, $max )};
            }
            $this->select( '*' )
                    ->from( 'cliente' )
                    ->where( "cliente_email = '$cliente_email'" )
                    ->execute();
            if ( !$this->result() )
            {
                $this->tpl( 'public/aluno_login.html' );
                $this->message_login = "$('#form-login').hide();$('#form-login-repass').show();";
                $this->message_login .= "$('#form-login-repass').popover({'trigger':'manual', 'placement':'right', 'title': 'Recuperação de senha:', 'content':'E-mail informado não cadastrado!'});";
                $this->message_login .= "$('#form-login-repass').popover('show');";
                $this->assign( 'message_login', "$this->message_login" );
                $this->render();
                exit;
            }

            $this->update( 'cliente' )
                    ->set( array( 'cliente_senha' ), array( md5( $pass ) ) )
                    ->where( "cliente_email = '$cliente_email'" );
            if ( $this->execute() )
            {
                if ( $this->result() )
                {
                    extract( $this->data[0] );
                }
                $site_title = $this->config->config_site_title;
                $bodyMail = "<h3>Recuperação de senha | $site_title</h3>";
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
                $mail->AddAddress( "$cliente_email" );
                $mail->Subject = "$site_title | Recuperação de senha";
                $mail->Body = $bodyMail;

                if ( $mail->Send() )
                {
                    $this->tpl( 'public/aluno_login.html' );
                    $this->message_login = "$('#form-login').show();$('#form-login-repass').hide();";
                    $this->message_login .= "$('#form-login #cliente_senha').popover({'trigger':'manual', 'placement':'right', 'title': 'Recuperação de senha:', 'content':'Sua nova senha foi enviada por e-mail!'});";
                    $this->message_login .= "$('#form-login #cliente_senha').popover('show');$('#cliente_email').val(\"$cliente_email\");";
                    $this->assign( 'message_login', "$this->message_login" );
                    $this->render();
                    exit;
                }
                else
                {
                    $this->tpl( 'public/aluno_login.html' );
                    $this->message_login = "$('#form-login').hide();$('#form-login-repass').show();";
                    $this->message_login .= "$('#form-login-repass').popover({'trigger':'manual', 'placement':'right', 'title': 'Recuperação de senha:', 'content':'Houve um erro ao enviar o e-mail! Entre em contato com suporte!'});";
                    $this->message_login .= "$('#form-login-repass').popover('show');";
                    $this->assign( 'message_login', "$this->message_login" );
                    $this->render();
                    exit;
                }
            }
            else
            {
                $this->tpl( 'public/aluno_login.html' );
                $this->message_login = "$('#form-login').hide();$('#form-login-repass').show();";
                $this->message_login .= "$('#form-login-repass').popover({'trigger':'manual', 'placement':'right', 'title': 'Recuperação de senha:', 'content':'Houve um erro ao alterar a senha! Entre em contato com suporte!'});";
                $this->message_login .= "$('#form-login-repass').popover('show');";
                $this->assign( 'message_login', "$this->message_login" );
                $this->render();
                exit;
            }
        }
        else
        {
            $this->tpl( 'public/aluno_login.html' );
                $this->message_login = "$('#form-login').hide();$('#form-login-repass').show();";
                $this->message_login .= "$('#form-login-repass').popover({'trigger':'manual', 'placement':'right', 'title': 'Recuperação de senha:', 'content':'E-mail informado não cadastrado!'});";
                $this->message_login .= "$('#form-login-repass').popover('show');";
            $this->assign( 'message_login', "$this->message_login" );
            $this->render();
            exit;
        }
    }

}

/* end file */