<?php

class Aluno extends PHPFrodo {

    public $ano = null;
    public $aluno_id = null;
    public $aluno_serie = null;

    public function __construct() {
        parent::__construct();

        $sid = new Session;
        $sid->start();

        if ($sid->getNode('cliente_id')) {
            $this->aluno_id = $sid->getNode('cliente_id');
        }
        if ($sid->getNode('cliente_sub')) {
            $this->aluno_serie = $sid->getNode('cliente_sub');
        }

        if (!$sid->check() || $this->aluno_id <= 0 || $this->aluno_id == null) {
            $this->redirect("$this->baseUri/loginAluno/logout/");
            exit;
        }

        setlocale(LC_ALL, 'pt_BR', 'ptb');
        $this->assign('mesExtenso', ucfirst(gmstrftime("%B")));

        $this->cliente_matricula = $sid->getNode('cliente_matricula');
        $this->cliente_id = $sid->getNode('cliente_id');
        $this->cliente_nome = $sid->getNode('cliente_nome');
        $this->cliente_sub = $sid->getNode('cliente_sub');
        $this->assign('cliente_nome', $this->cliente_nome);
        $this->assign('cliente_matricula', $this->cliente_matricula);
        $this->select()
                ->from('config')
                ->execute();
        if ($this->result()) {
            $this->config = (object) $this->data[0];
            $this->map($this->data[0]);
            $this->assignAll();
        }
        $this->ano_corrente = date('Y');
        $this->assign('ano_corrente', $this->ano_corrente);
        setlocale(LC_ALL, 'pt_BR', 'ptb');
        $this->assign('mesExtenso', ucfirst(gmstrftime("%B")));
        $this->ano = date('Y');
    }

    public function welcome() {
        $this->tpl('public/aluno_index.html')->render();
    }

    public function recados() {
        if (isset($this->uri_segment[2]) && $this->uri_segment[2] != 'page' && $this->uri_segment[2] != 'process-ok') {
            $read = true;
            $this->tpl('public/aluno_recado_ler.html');
            $recid = $this->uri_segment[2];
            $cond = "recado_cliente = $this->cliente_id AND recado_id = $recid";
        } else {
            $read = false;
            $this->tpl('public/aluno_recado.html');
            $cond = "recado_cliente = $this->cliente_id";
        }

        $this->pagebase = "$this->baseUri/aluno/recados";
        $this->select()
                ->from('recado')
                ->join('professor', 'professor_id = recado_professor', 'INNER')
                ->where("$cond")
                ->orderby('recado_id desc')
                ->paginate(7)
                ->execute();
        if ($this->result()) {
            $this->assign('pagelinks', $this->pagelinks);
            if ($read == false) {
                $this->fetch('r', $this->data);
            } else {
                $this->assignAll();
            }
        }

        $this->render();
    }

    public function recadolido() {
        if (isset($this->uri_segment[2])) {
            $recid = $this->uri_segment[2];
            $this->delete()->from('recado')->where("recado_id = $recid AND recado_cliente = $this->cliente_id")->execute();
            $this->redirect("$this->baseUri/aluno/recados/process-ok/");
        }
    }

    public function material() {
        $this->tpl('public/aluno_material.html');
        if (isset($this->uri_segment[3]) && $this->uri_segment[2] != 'page') {
            $this->mat = $this->uri_segment[3];
            $this->assign('onload', "$('#mat').val($this->mat)");
        }
        $this->fillMaterial();
        $this->fillDisc();
        $this->render();
    }

    public function fillMaterial() {
        $cond = "material_serie = $this->aluno_serie";
        if (isset($this->mat)) {
            $cond = "material_serie = $this->aluno_serie AND material_disc = $this->mat";
        }
        $this->pagebase = "$this->baseUri/aluno/material";
        $this->select()
                ->from('material')
                ->join('sub', 'material_serie = sub_id', 'INNER')
                ->join('disciplina', 'material_disc = disciplina_id', 'INNER')
                ->where("$cond")
                ->orderby('material_id desc')
                ->paginate(15)
                ->execute();
        if ($this->result()) {
            $this->assign('pagelinks', $this->pagelinks);
            $this->fetch('r', $this->data);
        }
    }

    public function fillDisc() {
        $this->select()
                ->from('profmat')
                ->join('disciplina', 'profmat_mat = disciplina_id', 'INNER')
                ->join('profserie', "profserie_sub = $this->cliente_sub", 'INNER')
                //->join( 'profmat', "profmat_prof = profserie_prof", 'INNER' )
                ->where("profmat_prof = profserie_prof AND profserie_sub  = $this->cliente_sub")
                ->groupby('disciplina_id')
                ->orderby('disciplina_nome asc')
                ->execute();
        if ($this->result()) {
            $this->assignAll();
            $this->fetch('d', $this->data);
        }
    }

    public function dados() {
        $this->tpl('public/aluno_dados.html');
        $this->select()
                ->from('cliente')
                ->join('categoria', 'cliente_categoria= categoria_id', 'INNER')
                ->join('sub', 'sub_id = cliente_sub', 'INNER')
                ->where("cliente_id = $this->aluno_id")
                ->execute();
        //$this->map();
        if ($this->data[0]['cliente_foto'] == 0) {
            $this->data[0]['cliente_foto'] = "user.png";
        }
        $this->assignAll();
        $this->render();
    }

    public function atualizar() {
        if (isset($_POST['cliente_senha']) && trim($_POST['cliente_senha'] != "")) {
            $pwd = md5(trim($_POST['cliente_senha']));
            $this->update('cliente')
                    ->set(array('cliente_senha'), array("$pwd"))
                    ->where("cliente_id = $this->aluno_id ")
                    ->execute();
        }
        $this->redirect("$this->baseUri/aluno/dados/process-ok/");
    }

    public function boletim() {
        $this->tpl('public/aluno_boletim.html');

        $this->select()
                ->from('boletim')
                ->join('bolemat', 'bolemat_boletim = boletim_id', 'INNER')
                ->join('sub', 'sub_id = bolemat_serie', 'INNER')
                ->join('categoria', 'categoria_id = sub_categoria', 'INNER')
                ->join('disciplina', 'bolemat_disciplina = disciplina_id', 'INNER')
                ->where("bolemat_cliente = $this->aluno_id AND bolemat_ano = '$this->ano_corrente'")
                ->execute();
        if ($this->result()) {
            $this->assignAll();
            $this->fetch('r', $this->data);
        }
        $this->render();
    }

    public function boletimImprimir2() {
        $this->tpl('public/aluno_boletim_imprimir.html');

        $this->select()
                ->from('boletim')
                ->join('bolemat', 'bolemat_boletim = boletim_id', 'INNER')
                ->join('sub', 'sub_id = bolemat_serie', 'INNER')
                ->join('categoria', 'categoria_id = sub_categoria', 'INNER')
                ->join('disciplina', 'bolemat_disciplina = disciplina_id', 'INNER')
                ->where("bolemat_cliente = $this->aluno_id AND bolemat_ano = '$this->ano_corrente'")
                ->execute();
        if ($this->result()) {
            $this->assignAll();
            $this->fetch('r', $this->data);
        }
        $this->render();
    }

    public function boletimImprimir() {
        $this->tpl('admin/boletim_serie.html');
        $this->cliente_id = $this->aluno_id;
        $tt = '';

        $this->select()
                ->from('sub')
                ->join('cliente', 'cliente_sub = sub_id', 'INNER')
                ->join('categoria', 'sub_categoria = categoria_id', 'INNER')
                ->where("cliente_id = $this->cliente_id")
                ->execute();
        if ($this->result()) {
            $this->assignAll();
            $all = $this->data;
            foreach ($all as $c) {
                //$this->map( $c );
                $this->cliente_id = $c['cliente_id'];
                $this->cliente_nome = $c['cliente_nome'];
                $this->cliente_matricula = $c['cliente_matricula'];
                $this->sub_title = $c['sub_title'];
                $this->categoria_title = $c['categoria_title'];

                $this->select()
                        ->from('boletim')
                        ->join('bolemat', 'bolemat_boletim = boletim_id', 'INNER')
                        ->join('sub', 'sub_id = bolemat_serie', 'INNER')
                        ->join('categoria', 'categoria_id = sub_categoria', 'INNER')
                        ->join('disciplina', 'bolemat_disciplina = disciplina_id', 'INNER')
                        ->join('cliente', 'bolemat_cliente = cliente_id', 'INNER')
                        ->where("bolemat_cliente = $this->cliente_id AND bolemat_ano = '$this->ano' AND bolemat_n1 <> '' ")
                        ->orderby('cliente_id asc')
                        ->execute();
                if ($this->result()) {
                    $this->map($this->data[0]);
                    $this->assignAll();
                    $data = $this->data;
                    //$t = '<div style="page-break-after:always !important;">';
                    $t = '<div class="table-break">';
                    $t .= '
                          <table  style="border:0px !important; margin-bottom:10px !important; width:85% !important">
                              <tr>
                                    <td style="border:0px !important;text-align:right"><img src="images/layout/topo2.png" /> </td>
                                </tr>
                         </table>
                        ';

                    $t .= '<table cellpadding="0" cellspacing="0" border="0"  class="table">';
                    $t .= '<thead>';

                    $t .= '</thead>';
                    $t .= '<tbody>';
                    $t .= '<tr> <td> <p><strong>Matrícula: </strong>'. $this->cliente_matricula .' </p></td> ';
                    $t .= '<td> <p><strong>Nome do Aluno: </strong> '. $this->cliente_nome .' </p></td> ';
                    $t .= '<td> <p><strong>Curso: </strong>'. $this->sub_title  .' | ' . $this->categoria_title . '</p></td> ';
                    $t .= '</tr>';
                    $t .= '</tbody>';
                    $t .= '<tfoot></tfoot>';
                    $t .= '</table><br/>';


//                    $t .= '
//                            <table id="header" cellpadding="0" cellspacing="0">
//                                <tr>
//                                    <td>
//                                        <p><strong>Nome do Aluno:</strong> ' . $this->cliente_nome . ' | <strong>Matrícula:</strong> ' . $this->cliente_matricula . '</p>
//
//                                        <p><strong>Série:</strong> ' . $this->sub_title . ' | <strong>Turno:</strong> ' . $this->categoria_title . '</p>
//                                    </td>
//                                </tr>
//                            </table>                            
//                        ';
                    $t .= '<table cellpadding="0" cellspacing="0" border="0"  class="table">';
                    $t .= '<thead>';
                    // $t .= '<tr>';
                    // $t .= '<th>&nbsp;</th>';
                    // $t .= '<th class="thFundoPreto" colspan="2">1º Bimestre</th>';
                    // $t .= '<th class="thFundoPreto" colspan="2">2º Bimestre</th>';
                    // $t .= '<th class="thFundoPreto" colspan="2">3º Bimestre</th>';
                    // $t .= '<th class="thFundoPreto" colspan="2">4º Bimestre</th>';
                    // $t .= '<th class="thFundoPreto" colspan="1">5º Avaliação</th>';
                    // $t .= '<th class="thFundoPreto" align="center" colspan="2">Final</th>';
                    // $t .= '</tr>';
                    $t .= '<tr>';
                    $t .= '<th>Disciplina</th>';
                    $t .= '<th class="thFundoCinza" >PROVA I</th>';
                    $t .= '<th class="thFundoCinza" >FALTAS</th>';
                    $t .= '<th class="thFundoCinza" >PROVA II</th>';
                    $t .= '<th class="thFundoCinza" >FALTAS</th>';
                    $t .= '<th class="thFundoCinza" >PROVA III</th>';
                    $t .= '<th class="thFundoCinza" >FALTAS</th>';
                    $t .= '<th class="thFundoCinza" >PROVA IV</th>';
                    $t .= '<th class="thFundoCinza" >FALTAS</th>';
                    $t .= '<th class="thFundoCinza" >PROVA V</th>';
                    $t .= '<th class="thFundoCinza" >MEDIA </th>';
                    $t .= '<th class="thFundoCinza" >FALTAS </th>';
                    $t .= '</tr>';
                    $t .= '</thead>';
                    $t .= '<tbody>';
                    foreach ($data as $a) {
                        $i = (object) $a;
                        $t .= '<tr>';
                        $t .= "<td>$i->disciplina_nome</td>";
                        $t .= "<td>$i->bolemat_n1</td>";
                        $t .= "<td>$i->bolemat_r1</td>";
                        $t .= "<td>$i->bolemat_n2</td>";
                        $t .= "<td>$i->bolemat_r2</td>";
                        $t .= "<td>$i->bolemat_n3</td>";
                        $t .= "<td>$i->bolemat_r3</td>";
                        $t .= "<td>$i->bolemat_n4</td>";
                        $t .= "<td>$i->bolemat_r4</td>";
                        $t .= "<td>$i->bolemat_m1</td>";
                        $t .= "<td>$i->bolemat_m2</td>";
                        $t .= "<td>$i->bolemat_m3</td>";
                        $t .= '</tr>';
                    }
                    $t .= '</tbody>';

                    $t .= '<tfoot></tfoot>';
                    $t .= '</table>';
                    $hora = date('d-m-Y H:i');
                    $t .= '
                        <p style="float:left;margin-right:10px;"><b>Observações:</b> </p><br/>
                         <div style="border:1px solid; height:70px;width:100%"></div>
                         <p style="float:right;margin-right:10px;">' . $hora . ' </p>
                        ';
                    $t .= '</div>';
                    $tt .= $t;
                }
            }
        }
        $this->assign('tab', $tt);
        $this->render();
    }

    public function download() {
        if (isset($this->uri_segment[2])) {
            $this->material_id = $this->uri_segment[2];
            $this->select()
                    ->from('material')
                    ->where("material_id = $this->material_id")
                    ->execute();
            $this->map($this->data[0]);
            $filename = $this->material_url;
            $fullpath = "app/download/$this->material_url";
            header("Pragma: public");
            header("Expires: 0");
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header("Cache-Control: private", false);
            header("Content-type: application/force-download");
            header("Content-Disposition: attachment; filename=\"" . basename($filename) . "\";");
            header("Content-Transfer-Encoding: binary");
            header("Content-Length: " . filesize($fullpath));
            readfile("$fullpath");
        }
    }

    public function updateFoto() {
        $this->select()
                ->from('cliente')
                ->where("cliente_id = $this->aluno_id")
                ->execute();
        $this->map($this->data[0]);
        $file = "app/fotos/$this->cliente_foto";
        if (file_exists($file)) {
            @unlink($file);
        }

        $file_dst_name = "";
        $dir_dest = 'app/fotos/';
        $files = array();
        $file = $_FILES['cliente_foto'];
        $handle = new Upload($file);
        if ($handle->uploaded) {
            $handle->file_overwrite = true;
            $handle->file_new_name_body = md5(uniqid(time()));
            $handle->process($dir_dest);
            if ($handle->processed) {
                $this->update('cliente')
                        ->set(array('cliente_foto'), array($handle->file_dst_name))
                        ->where("cliente_id = $this->aluno_id")
                        ->execute();
                echo $handle->file_dst_name;
                $handle->clean();
            } else {
                echo "user.png";
            }
        }
    }

}

/*end file*/