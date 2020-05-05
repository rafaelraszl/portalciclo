<?php

class Uploadr extends PHPFrodo
{

    public function __construct()
    {
        parent:: __construct();
    }

    public function welcome()
    {
        $cliente_id = $this->uri_segment[1];

        $this->select()->from( 'cliente' )->where( "cliente_id = $cliente_id" )->execute();
        if ( $this->result() )
        {
            $this->map( $this->data[0] );
            $this->cliente_nome = $this->urlmodr( $this->cliente_nome, null,null,'_' );
        }
        $file_dst_name = "";
        $dir_dest = 'app/uploads/';
        $files = array( );
        $file = $_FILES['Filedata'];
        $handle = new Upload( $file );
        if ( $handle->uploaded )
        {
            $handle->file_overwrite = true;
            $handle->file_new_name_body = $this->cliente_nome . "_" . $this->cliente_id;
            $handle->process( $dir_dest );
            if ( $handle->processed )
            {
                $this->update( 'cliente' )
                        ->set( array( 'cliente_contrato' ), array( "$handle->file_dst_name" ) )
                        ->where( "cliente_id = $cliente_id" )
                        ->execute();
                echo json_encode( array( 'url' => "error", 'id' => '', 'time' => time() ) );
                $handle->clean();
            }
            else
            {
                echo json_encode( array( 'url' => "$handle->error", 'id' => '', 'time' => time() ) );
                exit;
            }
        }
    }

}
