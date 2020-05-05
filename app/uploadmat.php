<?php

class Uploadmat extends PHPFrodo
{

    public function __construct()
    {
        parent:: __construct();
    }

    public function welcome()
    {
        $professor_id = $this->uri_segment[1];
        $sub_id = $this->uri_segment[2];
        $mat_id = $this->uri_segment[3];
        $nome = utf8_decode( trim( $_REQUEST['titulo'] ) );
        $f = "";
        $url = $this->urlmodr( $nome );
        $file_dst_name = "";
        $dir_dest = 'app/download/';
        $files = array( );
        $file = $_FILES['Filedata'];
        $handle = new Upload( $file );
        if ( $handle->uploaded )
        {
            $handle->file_overwrite = true;
            $handle->file_new_name_body = $professor_id . "_" . $sub_id . "_" . $url;
            $handle->process( $dir_dest );
            if ( $handle->processed )
            {
                $this->insert( 'material' )
                        ->fields( array( 'material_serie', 'material_professor', 'material_disc', 'material_nome', 'material_data', 'material_url' ) )
                        ->values( array( "$sub_id", "$professor_id", "$mat_id", "$nome", date( 'd/m/Y' ), "$handle->file_dst_name" ) )
                        ->execute();
                echo json_encode( array( 'url' => "error", 'id' => $f, 'time' => time() ) );
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
