<?php

class Cliente extends PHPFrodo
{

    public $login = null;
    public $user_login;
    public $user_id;
    public $user_name;
    public $cliente_id;
    public $cliente_cpf;
    public $cliente_nome;
    public $cliente_email;

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
        $this->select()
                ->from( 'config' )
                ->execute();
        if ( $this->result() )
        {
            $this->config = ( object ) $this->data[0];
            $this->map( $this->data[0] );
            $this->assignAll();
        }
        if ( isset( $this->uri_segment ) && in_array( 'process-ok', $this->uri_segment ) )
        {
            $this->assign( 'msgOnload', 'notify("<h1>Procedimento realizado com sucesso</h1>")' );
        }
        if ( isset( $this->uri_segment ) && in_array( 'cobranca', $this->uri_segment ) )
        {
            $tab = "$('#myTab a[href=\"#cobranca\"]').tab('show')";
            $this->assign( 'loadTab', $tab );
        }


        $this->user_login = $sid->getNode( 'user_login' );
        $this->user_id = $sid->getNode( 'user_id' );
        $this->user_name = $sid->getNode( 'user_name' );
        $this->assign( 'user_name', $this->user_name );
        setlocale( LC_ALL, 'pt_BR', 'ptb' );
        $this->assign( 'mesExtenso', ucfirst( gmstrftime( "%B" ) ) );
    }

    public function welcome()
    {
        $this->pagebase = "$this->baseUri/admin/cliente";
        $this->tpl( 'admin/cliente.html' );
        $this->select()
                ->from( 'cliente' )
                ->join( 'sub', 'sub_id = cliente_sub', 'INNER' )
                ->join( 'categoria', 'categoria_id = sub_categoria', 'INNER' )
                ->paginate( 11 )
                ->orderby( 'cliente_nome asc' )
                ->execute();
        if ( $this->result() )
        {
            $this->fetch( 'cl', $this->data );
            //$this->fillCategoria();
            $this->assign( 'cliente_qtde', $this->getTotalCliente() );
        }
        $this->render();
    }

    public function aniversariante()
    {
        $this->pagebase = "$this->baseUri/admin/cliente";
        $datan = date( 'm' );
        $this->tpl( 'admin/cliente.html' );
        $this->select()
                ->from( 'cliente' )
                ->join( 'sub', 'sub_id = cliente_sub', 'INNER' )
                ->join( 'categoria', 'categoria_id = sub_categoria', 'INNER' )
                ->where( "cliente_datan like'%/$datan/%'" )
                ->orderby( 'cliente_nome asc' )
                ->execute();
        //echo $this->query;exit;
        if ( $this->result() )
        {
            $this->fetch( 'cl', $this->data );
            //$this->fillCategoria();
            $this->assign( 'cliente_qtde', count( $this->data ) );
        }
        $this->view->contents = preg_replace( '/<b>Alunos Cadastrados <\/b>/', 'Aniversariantes do mês', $this->view->contents );
        $this->render();
    }

    public function busca()
    {
        $this->tpl( 'admin/cliente_busca.html' );
        $term = "";
        $cond = "1 = 0";
        if ( isset( $this->uri_segment[2] ) )
        {
            $term = $this->uri_segment[2];
        }

        $this->assign( 'turno', "1" );
        $this->assign( 'cliente_nome', "" );
        if ( $term == 'nome' )
        {
            $cliente_nome = "";
            if ( isset( $_POST['busca'] ) )
            {
                $cliente_nome = $_POST['busca'];
                $cond = "cliente_nome like'%$cliente_nome%'";
                $this->assign( 'busca', "$cliente_nome" );
            }
        }
        elseif ( $term == 'turno' )
        {
            $turno = $_POST['cliente_categoria'];
            $serie = $_POST['cliente_sub'];
            $cond = "categoria_id = $turno and sub_id = $serie";
            $this->assign( 'msgOnload', "$('#cliente_categoria').val('$turno')" );
        }
        elseif ( $term == 'matricula' )
        {
            $matricula = $_POST['cliente_matricula'];
            $cond = "cliente_matricula = '$matricula'";
            $this->assign( 'cliente_matricula', "$matricula" );
        }

        if ( $term != "" )
        {
            $this->select()
                    ->from( 'cliente' )
                    ->join( 'sub', 'sub_id = cliente_sub', 'INNER' )
                    ->join( 'categoria', 'sub_categoria = categoria_id', 'INNER' )
                    ->where( "$cond" )
                    ->orderby( 'cliente_nome asc' )
                    ->execute();
            if ( $this->result() )
            {
                $this->assign( 'cliente_qtde', count( $this->data ) );
                $this->fetch( 'cl', $this->data );
                $this->assign( 'msgOnload', "$('.accordion-toggle').click()" );
            }
            else
            {
                $this->assign( 'showHide', "hide" );
                $this->assign( 'msg_busca', '<h5 class="alert">Nenhum aluno encontrado.</h5>' );
            }
        }
        else
        {
            $this->assign( 'showHide', "hide" );
        }

        $this->fillCategoria();
        $this->render();
    }

    public function getTotalCliente()
    {
        $this->select()->from( 'cliente' )->execute();
        if ( $this->result() )
        {
            return count( $this->data );
        }
        else
        {
            return 0;
        }
    }

    public function novo()
    {
        $this->tpl( 'admin/cliente_novo.html' );
        $this->assign( 'cliente_ano_matricula', date( 'Y' ) );
        $this->fillCategoria();
        $this->render();
    }

    public function editar()
    {
        if ( isset( $this->uri_segment[2] ) )
        {
            $this->cliente_id = $this->uri_segment[2];
            $this->tpl( 'admin/cliente_editar.html' );

            $this->select()
                    ->from( 'cliente' )
                    ->join( 'sub', 'sub_id = cliente_sub', 'INNER' )
                    ->join( 'categoria', 'categoria_id = sub_categoria', 'INNER' )
                    ->where( "cliente_id = $this->cliente_id" )
                    ->execute();
            if ( $this->result() )
            {
                $this->map( $this->data[0] );
                if ( strlen( $this->cliente_contrato ) <= 1 )
                {
                    $this->data[0]['cliente_contrato'] = "Nenhum contrato foi enviado";
                    $this->data[0]['contrato_link'] = "javascript:;";
                    $this->assign( 'showHideLink', 'hide' );
                }
                $this->data[0]['cliente_fotoe'] = $this->data[0]['cliente_foto'];
                if ( $this->data[0]['cliente_fotoe'] == '0' )
                {
                    $this->data[0]['cliente_fotoe'] = 'user.png';
                }
                else
                {
                    $file = "app/fotos/" . $this->data[0]['cliente_fotoe'];
                    if ( !file_exists( $file ) )
                    {
                        $this->data[0]['cliente_fotoe'] = 'user.png';
                    }
                }
                $this->assignAll();
                $this->fillCategoria();
            }
            else
            {
                $this->redirect( "$this->baseUri/admin/cliente/" );
            }
            if ( isset( $this->uri_segment[3] ) )
            {
                $tab = $this->uri_segment[3];
                $tab = "$('#myTab a[href=\"#$tab\"]').tab('show')";
                $this->assign( 'loadTab', $tab );
            }

            $ano = date( 'Y' );
            if ( isset( $this->uri_segment[4] ) )
            {
                $ano = $this->uri_segment[4];
            }
            $this->addMensal( $ano );
            $this->assign( 'year', $ano );
            $this->fillAno();
            $this->fillInfo();
            $this->render();
        }
    }

    public function addInfo()
    {
        $valid = array( 'info_txt' => 'string' );
        if ( $this->postIsValid( $valid ) )
        {
            $this->postIndexAdd( 'info_user', "$this->user_name" );
            $this->postIndexAdd( 'info_data', date( 'd/m/Y h:i' ) );
            $this->insert( 'info' )->fields()->values()->execute();
            $this->cliente_id = $this->postGetValue( 'info_cliente' );
            $this->redirect( "$this->baseUri/admin/cliente/editar/$this->cliente_id/cobranca/" );
        }
    }

    public function remInfo()
    {
        if ( isset( $this->uri_segment[2] ) )
        {
            $this->info_id = $this->uri_segment[2];
            $this->cliente_id = $this->uri_segment[3];
            $this->delete()
                    ->from( 'info' )
                    ->where( "info_id = $this->info_id" )
                    ->execute();
            $this->redirect( "$this->baseUri/admin/cliente/editar/$this->cliente_id/cobranca/" );
        }
    }

    public function fillInfo()
    {
        $this->select()
                ->from( 'info' )
                ->where( "info_cliente = $this->cliente_id" )
                ->orderby( 'info_id desc' )
                ->execute();
        if ( $this->result() )
        {
            $this->fetch( 'cob', $this->data );
        }
    }

    public function fillAno()
    {
        $y = array( );
        $start = $this->config_site_ano;
        $current = intval( date( 'Y' ) );
        for ( $i = $start; $i <= $current + 1; $i++ )
        {
            array_push( $y, array( 'ano' => $i ) );
        }
        $this->fetch( 'Y', $y );
    }

    public function addMensal( $ano )
    {
        $this->assign( 'year', $ano );
        $this->select()
                ->from( 'mensal' )
                ->join( 'cliente', 'mensal_cliente = cliente_id', 'INNER' )
                ->where( "mensal_ano = '$ano' and mensal_cliente = $this->cliente_id" )
                ->execute();
        if ( $this->result() )
        {
            $this->money( 'mensal_jan' );
            $this->money( 'mensal_fev' );
            $this->money( 'mensal_mar' );
            $this->assignAll();
        }
        else
        {
            $f = array( 'mensal_jan', 'mensal_fev', 'mensal_mar', 'mensal_abr', 'mensal_mai',
                'mensal_jun', 'mensal_jul', 'mensal_ago', 'mensal_set', 'mensal_out', 'mensal_nov', 'mensal_dez',
                'mensal_pjan', 'mensal_pfev', 'mensal_pmar', 'mensal_pabr', 'mensal_pmai',
                'mensal_pjun', 'mensal_pjul', 'mensal_pago', 'mensal_pset', 'mensal_pout', 'mensal_pnov', 'mensal_pdez', 'mensal_ano', 'mensal_cliente' );
            $v = array( 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', "$ano", $this->cliente_id );
            $this->insert( 'mensal' )->fields( $f )->values( $v )->execute();
            $this->select()
                    ->from( 'mensal' )
                    ->join( 'cliente', 'mensal_cliente = cliente_id', 'INNER' )
                    ->where( "mensal_ano = '$ano' and mensal_cliente = $this->cliente_id" )
                    ->execute();
            $this->money( 'mensal_jan' );
            $this->money( 'mensal_fev' );
            $this->money( 'mensal_mar' );
            $this->assignAll();
        }
    }

    public function updateMensalidade()
    {
        parse_str( $_POST['arr'], $arr );

        foreach ( $arr as $k => $v )
        {
            $arr[$k] = preg_replace( array( '/,/' ), array( '.' ), $arr[$k] );
        }
        //$this->printr($arr);exit;
        $this->post2Query( $arr );
        $this->cliente_id = $this->postGetValue( 'mensal_cliente' );
        $ano = $this->postGetValue( 'mensal_ano' );
        $this->update( 'mensal' )->set()->where( "mensal_cliente = $this->cliente_id and mensal_ano = '$ano'" )->execute();
        $pagos = array( );
        foreach ( $arr as $k => $v )
        {
            if ( !preg_match( '/mensal_p/', $k ) )
                if ( $k != "mensal_ano" && $k != "mensal_cliente" )
                {
                    if ( $v != "" && $v != "0.00" )
                    {
                        array_push( $pagos, $k );
                    }
                }
        }
        echo json_encode( $pagos );
    }

    public function atualizar()
    {
        $this->tpl( 'admin/cliente_editar.html' );
        $valid = array(
            'cliente_id' => 'string',
            'cliente_nome' => 'string',
            //'cliente_cpf' => 'cpf',
            'cliente_datan' => 'string',
            'cliente_telefone' => 'string',
            'cliente_cep' => 'string',
            'cliente_rua' => 'string',
            'cliente_num' => 'string',
            'cliente_bairro' => 'string',
            'cliente_cidade' => 'string',
            'cliente_uf' => 'string',
        );
        if ( $this->postIsValid( $valid ) )
        {
            $this->login = array(
                'cliente_email' => $this->postGetValue( 'cliente_email' ),
                'cliente_nome' => $this->postGetValue( 'cliente_nome' ),
                'cliente_id' => $this->postGetValue( 'cliente_id' )
            );
            $this->cliente_id = $this->postGetValue( 'cliente_id' );

            $this->cliente_senha = trim( $this->postGetValue( 'cliente_senha' ) );
            if ( $this->cliente_senha == "" )
            {
                $this->postIndexDrop( 'cliente_senha' );
            }
            else
            {
                $this->postValueChange( 'cliente_senha', md5( $this->cliente_senha ) );
            }
            $this->msg_error = "";
            if ( $this->msg_error == "" )
            {
                $this->update( 'cliente' )->set()->where( "cliente_id = $this->cliente_id" )->execute();
            }
            else
            {
                $this->assign( 'msg_error', $this->msg_error );
            }
            $this->fillCategoria();
            $this->fillDados();
            if ( $this->msg_error != "" )
            {
                //$this->assign( 'cliente_cpf', $this->cliente_cpf );
                $this->assign( 'cliente_email', $this->cliente_email );
                $this->assign( 'cliente_nome', $this->postGetValue( 'cliente_nome' ) );
                $this->assign( 'cliente_datan', $this->postGetValue( 'cliente_datan' ) );
                $this->assign( 'cliente_telefone', $this->postGetValue( 'cliente_telefone' ) );
                $this->assign( 'cliente_celular', $this->postGetValue( 'cliente_celular' ) );
                $this->assign( 'cliente_cep', $this->postGetValue( 'cliente_cep' ) );
                $this->assign( 'cliente_rua', $this->postGetValue( 'cliente_rua' ) );
                $this->assign( 'cliente_num', $this->postGetValue( 'cliente_num' ) );
                $this->assign( 'cliente_cidade', $this->postGetValue( 'cliente_cidade' ) );
                $this->assign( 'cliente_bairro', $this->postGetValue( 'cliente_bairro' ) );
                $this->assign( 'cliente_complemento', $this->postGetValue( 'cliente_complemento' ) );
                $this->assign( 'cliente_uf', $this->postGetValue( 'cliente_uf' ) );
            }
            else
            {
                //$this->msg_error = "$('#cliente_nome').popover({'trigger':'focus','placement':'right','title': 'Atualizado com sucesso!','content':'O cadastro foi atualizado!'});\n";
                //$this->msg_error .= "$('#cliente_nome').popover('show');\n";
                $this->redirect( "$this->baseUri/admin/cliente/editar/$this->cliente_id/process-ok/" );
                //$this->msg_error = "notify('<h1>Atualizado com sucesso!</h1>');\n";
                //$this->assign( 'msg_error', $this->msg_error );
            }
        }
        else
        {
            $this->pageError();
        }
        $this->render();
    }

    public function incluir()
    {
        $valid = array(
            'cliente_nome' => 'string',
            //'cliente_cpf' => 'cpf',
            'cliente_datan' => 'string',
            'cliente_telefone' => 'string',
            'cliente_cep' => 'string',
            'cliente_rua' => 'string',
            'cliente_num' => 'string',
            'cliente_bairro' => 'string',
            'cliente_cidade' => 'string',
            'cliente_uf' => 'string',
        );
        if ( $this->postIsValid( $valid ) )
        {
            $this->cliente_senha = trim( $this->postGetValue( 'cliente_senha' ) );
            $this->postValueChange( 'cliente_senha', md5( $this->cliente_senha ) );
            $this->insert( 'cliente' )->fields()->values()->execute();
            $this->cliente_id = mysql_insert_id();
            $this->redirect( "$this->baseUri/admin/cliente/editar/$this->cliente_id/process-ok/" );
        }
        else
        {
            echo $this->response;
            $this->pageError();
        }
    }

    public function checkCPF()
    {
        if ( $this->login != null )
        {
            $cond = "cliente_cpf = '$this->cliente_cpf' AND cliente_id <> $this->cliente_id";
        }
        else
        {
            $cond = "cliente_cpf = '$this->cliente_cpf'";
        }
        $this->select()
                ->from( 'cliente' )
                ->where( "$cond" )
                ->execute();
        if ( $this->result() )
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function checkMail()
    {
        if ( $this->login != null )
        {
            $cond = "cliente_email = '$this->cliente_email' AND cliente_id <> $this->cliente_id";
        }
        else
        {
            $cond = "cliente_email = '$this->cliente_email'";
        }
        $this->select()
                ->from( 'cliente' )
                ->where( "$cond" )
                ->execute();
        if ( $this->result() )
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function remover()
    {
        if ( isset( $this->uri_segment[2] ) )
        {
            $this->cliente_id = $this->uri_segment[2];
            $this->delete()
                    ->from( 'cliente' )
                    ->where( "cliente_id = $this->cliente_id" )
                    ->execute();
            $this->redirect( "$this->baseUri/admin/cliente/" );
        }
    }

    public function removerContrato()
    {
        if ( isset( $this->uri_segment[2] ) )
        {
            $this->cliente_id = $this->uri_segment[2];

            $this->select()
                    ->from( 'cliente' )
                    ->where( "cliente_id = $this->cliente_id" )
                    ->execute();
            $this->map( $this->data[0] );
            $file = "app/uploads/$this->cliente_contrato";
            if ( file_exists( $file ) )
            {
                @unlink( $file );
            }
            $this->update( 'cliente' )->set( array( 'cliente_contrato' ), array( '' ) )->where( "cliente_id = $this->cliente_id" )->execute();
            $this->redirect( "$this->baseUri/admin/cliente/editar/$this->cliente_id/contrato/process-ok/" );
        }
    }

    public function fillDados()
    {
        $this->select()
                ->from( 'cliente' )
                ->join( 'sub', 'sub_id = cliente_sub', 'INNER' )
                ->join( 'categoria', 'categoria_id = sub_categoria', 'INNER' )
                ->where( "cliente_id = $this->cliente_id" )
                ->execute();
        if ( $this->result() )
        {
            $this->assignAll();
        }
    }

    public function pageError()
    {
        
    }

    public function fillCategoria()
    {
        $this->select()
                ->from( 'categoria' )
                ->orderby( 'categoria_title asc' )
                ->execute();
        if ( $this->result() )
        {
            $this->fetch( 'combo', $this->data );
        }
    }

    public function fillSubCategoria()
    {
        if ( isset( $this->uri_segment[2] ) )
        {
            $this->categoria_id = $this->uri_segment[2];
            $this->select( 'sub_id,sub_title' )
                    ->from( 'sub' )
                    ->where( "sub_categoria = $this->categoria_id" )
                    ->orderby( 'sub_title asc' )
                    ->execute();
            if ( $this->result() )
            {
                @header( 'Content-Type: text/html; charset=iso-8859-1' );
                echo $this->toJson();
            }
            else
            {
                echo 0;
            }
        }
    }

    public function download()
    {
        if ( isset( $this->uri_segment[2] ) )
        {
            $this->cliente_id = $this->uri_segment[2];
            $this->select()
                    ->from( 'cliente' )
                    ->where( "cliente_id = $this->cliente_id" )
                    ->execute();
            $this->map( $this->data[0] );
            $filename = $this->cliente_contrato;
            $fullpath = "app/uploads/$this->cliente_contrato";
            header( "Pragma: public" );
            header( "Expires: 0" );
            header( "Cache-Control: must-revalidate, post-check=0, pre-check=0" );
            header( "Cache-Control: private", false );
            header( "Content-type: application/force-download" );
            header( "Content-Disposition: attachment; filename=\"" . basename( $filename ) . "\";" );
            header( "Content-Transfer-Encoding: binary" );
            header( "Content-Length: " . filesize( $fullpath ) );
            readfile( "$fullpath" );
        }
    }

    public function updateFoto()
    {
        if ( isset( $this->uri_segment[2] ) )
        {
            $this->cliente_id = $this->uri_segment[2];
            $this->select()
                    ->from( 'cliente' )
                    ->where( "cliente_id = $this->cliente_id" )
                    ->execute();
            $this->map( $this->data[0] );
            $file = "app/fotos/$this->cliente_foto";
            if ( file_exists( $file ) )
            {
                @unlink( $file );
            }
            $file_dst_name = "";
            $dir_dest = 'app/fotos/';
            $files = array( );
            $file = $_FILES['cliente_foto'];
            $handle = new Upload( $file );
            if ( $handle->uploaded )
            {
                $handle->file_overwrite = true;
                //$handle->file_new_name_body = $this->cliente_nome . "_" . $this->cliente_id;
                $handle->file_new_name_body = md5( uniqid( time() ) );
                $handle->process( $dir_dest );
                if ( $handle->processed )
                {
                    $this->update( 'cliente' )
                            ->set( array( 'cliente_foto' ), array( $handle->file_dst_name ) )
                            ->where( "cliente_id = $this->cliente_id" )
                            ->execute();
                    $handle->clean();
                    echo $handle->file_dst_name;
                }
                else
                {
                    echo "user.png";
                }
            }
        }
    }

}

/*end file*/