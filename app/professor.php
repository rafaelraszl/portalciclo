<?php

class Professor extends PHPFrodo {

    public $professor_id = null;
    public $aluno_id = null;
    public $sub = null;
    public $mat = null;
    public $ano = null;
    public $ano_inicial = null;
    public $config = null;
    public $boletim = null;
    public $msgPageError = "";

    public function __construct() {
        parent::__construct();
        $sid = new Session;
        $sid->start();

        if ($sid->getNode('professor_id')) {
            $this->professor_id = $sid->getNode('professor_id');
        }

        if (!$sid->check() || $this->professor_id <= 0 || $this->professor_id == null) {
            $this->redirect("$this->baseUri/loginProfessor/logout/");
            exit;
        }

        if (in_array('process-ok', $this->uri_segment)) {
            $this->assign('proc-ok', 'notifyr("Procedimento realizado com sucesso!")');
        }

        setlocale(LC_ALL, 'pt_BR', 'ptb');
        $this->assign('mesExtenso', ucfirst(gmstrftime("%B")));

        $this->professor_login = $sid->getNode('professor_login');
        $this->professor_nome = $sid->getNode('professor_nome');
        $this->assign('professor_nome', $this->professor_nome);
        $this->select()
                ->from('config')
                ->execute();
        if ($this->result()) {
            $this->ano_inicial = $this->data[0]['config_site_ano'];
            $this->config = (object) $this->data[0];
            $this->map($this->data[0]);
            $this->assignAll();
        }
        $this->ano = date('Y');
        $this->assign('currentYear', $this->ano);
        $this->ano_corrente = $this->ano;
        $this->assign('ano_corrente', $this->ano_corrente);
        setlocale(LC_ALL, 'pt_BR', 'ptb');
        $this->assign('mesExtenso', ucfirst(gmstrftime("%B")));
    }

    public function welcome() {
        $this->tpl('public/professor_index.html')->render();
    }

    public function recados() {
        $this->tpl('public/professor_recado.html');
        if (isset($this->uri_segment[3])) {
            $this->sub = $this->uri_segment[3];
            $this->assign('onLoadSub', "$('#sub').val($this->sub)");
            $this->fillSub();
            $this->fillAluno();
        } else {
            $this->fillSub();
            $this->assign('onLoad', 'hider("tbl-func");hider("divRec");');
        }
        $this->render();
    }

    public function fillAluno() {
        $this->select()
                ->from('cliente')
                ->join('sub', 'cliente_sub = sub_id', 'INNER')
                ->where("cliente_sub = $this->sub")
                ->orderby('cliente_nome asc')
                ->execute();
        if ($this->result()) {
            $this->assignAll();
            $this->fetch('r', $this->data);
        } else {
            $this->assign('onLoad', 'showr("divSub");');
            $this->assign('onLoadResponse', 'hider("divTab")');
            $this->assign('onLoadResponse', 'hider("divRec");$("#divTab").html("<p class=\'alert alert-error\'>Nenhum aluno cadastrado!</p>")');
            $this->fillSub();
        }
    }

    public function fillSub() {
        $this->select()
                ->from('profserie')
                ->join('sub', 'profserie_sub = sub_id', 'INNER')
                ->join('categoria', 'categoria_id = sub_categoria', 'INNER')
                ->where("profserie_prof = $this->professor_id")
                ->execute();
        if ($this->result()) {
            $this->assignAll();
            $this->fetch('s', $this->data);
        }
    }

    public function recadoSend() {
        if (isset($_POST['notificacao']) && !empty($_POST['notificacao'])) {
            $assunto = trim($_POST['assunto']);
            $mensagem = trim($_POST['notificacao']);
            $finalAux = array();
            $this->data = array();
            foreach ($_POST['check'] as $k => $v) {
                if ($_POST['check'][$k] != 0) {
                    $finalAux[] = $_POST['check'][$k];
                }
            }
            if (isset($finalAux[0])) {
                foreach ($finalAux as $k) {
                    $f = array('recado_cliente', 'recado_assunto', 'recado_mensagem', 'recado_professor', 'recado_data');
                    $v = array("$k", "$assunto", "$mensagem", $this->professor_id, date('d/m/Y h:i'));
                    $this->insert('recado')->fields($f)->values($v)->execute();
                }
                $this->redirect("$this->baseUri/professor/recados/process-ok/");
            } else {
                $this->msgPageError = "Nenhuma mensagem foi escrita!";
                $this->pageError();
            }
        } else {
            $this->msgPageError = "Nenhum funcionário foi selecionado!";
            $this->pageError();
        }
    }

    public function material() {
        $this->tpl('public/professor_material.html');
        if (isset($this->uri_segment[3])) {
            $this->sub = $this->uri_segment[3];
            $this->assign('onLoadSub', "$('#sub').val($this->sub)");
            $this->assign('serie', "$this->sub");
            $this->assign('prof', "$this->professor_id");
            if (isset($this->uri_segment[5])) {
                $this->mat = $this->uri_segment[5];
                $this->assign('mat', "$this->mat");
                $this->assign('onLoadSub', "$('#sub').val($this->sub);$('#mat').val($this->mat)");
            } else {
                $this->assign('onLoad', 'hider("divTit");');
            }
            $this->fillSub();
            $this->fillDisc();
            $this->fillMaterial();
        } else {
            $this->fillSub();
            $this->fillMaterial();
            $this->assign('onLoad', 'hider("divRec");hider("divMat");hider("divTit");');
        }
        $this->render();
    }

    public function materialNovo() {
        $this->tpl('public/professor_material_enviar.html');
        if (isset($this->uri_segment[3])) {
            $this->sub = $this->uri_segment[3];
            $this->assign('onLoadSub', "$('#sub').val($this->sub)");
            $this->assign('serie', "$this->sub");
            $this->assign('prof', "$this->professor_id");
            if (isset($this->uri_segment[5])) {
                $this->mat = $this->uri_segment[5];
                $this->assign('mat', "$this->mat");
                $this->assign('onLoadSub', "$('#sub').val($this->sub);$('#mat').val($this->mat)");
            } else {
                $this->assign('onLoad', 'hider("divTit");');
            }
            $this->fillSub();
            $this->fillDisc();
        } else {
            $this->fillSub();
            $this->assign('onLoad', 'hider("divRec");hider("divMat");hider("divTit");');
        }
        $this->render();
    }

    public function fillMaterial() {
        $cond = "material_professor = $this->professor_id";
        if (isset($this->sub)) {
            $cond = "material_professor = $this->professor_id AND material_serie = $this->sub";
        }
        if (isset($this->uri_segment[5])) {
            $this->disc = $this->uri_segment[5];
            $cond .= " AND material_disc = $this->disc";
        }
        $this->select()
                ->from('material')
                ->join('sub', 'material_serie = sub_id', 'INNER')
                ->join('disciplina', 'material_disc = disciplina_id', 'INNER')
                ->where("$cond")
                ->orderby('material_id desc')
                ->execute();
        if ($this->result()) {
            $this->fetch('r', $this->data);
        }
    }

    public function fillDisc() {
        $this->select()
                ->from('profmat')
                ->join('disciplina', 'profmat_mat = disciplina_id', 'INNER')
                ->where("profmat_prof = $this->professor_id")
                ->execute();
        if ($this->result()) {
            $this->assignAll();
            $this->fetch('d', $this->data);
        }
    }

    public function fillAno() {
        $ano = array();
        $hj = date('Y') + 1;
        for ($i = $this->ano_inicial; $i <= $hj; $i++) {
            $ano[] = array('ano' => $i);
        }
        $this->fetch('a', $ano);
    }

    public function removeMaterial() {
        if (isset($this->uri_segment[2])) {
            $this->mat_id = $this->uri_segment[2];
            $this->select()->from('material')->where("material_id = $this->mat_id")->execute();
            if ($this->result()) {
                $file = 'app/download/' . $this->data[0]['material_url'];
                if (file_exists($file)) {
                    @unlink($file);
                }
                $this->delete()->from('material')->where("material_id = $this->mat_id")->execute();
            }
            $this->redirect("$this->baseUri/professor/material/");
        }
    }

    public function dados() {
        $this->tpl('public/professor_dados.html');
        $this->select()
                ->from('professor')
                ->where("professor_id = $this->professor_id")
                ->execute();
        $this->assignAll();
        $this->render();
    }

    public function atualizar() {
        if (isset($this->uri_segment[2])) {
            $this->professor_id = $this->uri_segment[2];
        }
        if (isset($_POST['professor_senha']) && trim($_POST['professor_senha'] != "")) {
            $pwd = md5(trim($_POST['professor_senha']));
            $this->update('professor')
                    ->set(array('professor_senha'), array("$pwd"))
                    ->where("professor_id = $this->professor_id ")
                    ->execute();
        }
        $this->redirect("$this->baseUri/professor/dados/process-ok/");
    }

    public function boletim() {
        $this->tpl('public/professor_boletim.html');
        $onload = "";
        if (isset($this->uri_segment[3])) {
            $this->sub = $this->uri_segment[3];
            $this->assign('onLoadSub', "$('#sub').val($this->sub)");
            $this->assign('serie', "$this->sub");
            $this->assign('prof', "$this->professor_id");
            $onload .= "$('#sub').val($this->sub);";
            if (isset($this->uri_segment[5])) {
                $this->mat = $this->uri_segment[5];
                $this->assign('mat', "$this->mat");
                $onload .= "$('#mat').val($this->mat);";
            } else {
                $this->assign('onLoad', 'hider("divTit");hider("divAluno");');
            }

            $this->fillSub();
            $this->fillDisc();
            $this->fillAluno();

            if (isset($this->uri_segment[7])) {
                $aluno = $this->uri_segment[7];
                $onload .= "$('#aluno').val($aluno);";
                $this->aluno_id = $aluno;
                $this->assign('aluno_id', $this->aluno_id);
                $this->checkBoletim();
                if (!isset($this->uri_segment[8])) {
                    $this->redirect("$this->baseUri/professor/boletim/turma/$this->sub/disciplina/$this->mat/aluno/$this->aluno_id/atualizar-gerado/");
                }
                $this->assign('boletim_id', "$this->boletim_id");
                $this->assign('bolemat_id', "$this->bolemat_id");
            } else {
                $onload .= 'hider("divBoletim");';
            }
            $this->assign('onLoadSub', "$onload");
        } else {
            $this->fillSub();
            $this->assign('onLoad', 'hider("divRec");hider("divMat");hider("divTit");hider("divAluno");hider("divBoletim");');
        }
        $this->render();
    }

    public function checkBoletim() {
        $this->select()
                ->from('boletim')
                ->where("boletim_cliente = $this->aluno_id AND boletim_professor = $this->professor_id AND boletim_ano = $this->ano")
                ->execute();
        if (!$this->result()) {
            $f = array('boletim_cliente', 'boletim_professor', 'boletim_serie', 'boletim_ano');
            $v = array($this->aluno_id, $this->professor_id, $this->sub, $this->ano);
            $this->insert('boletim')->fields($f)->values($v)->execute();
            $boletim_id = mysql_insert_id();
            $this->boletim_id = $boletim_id;
        } else {
            $this->boletim = $this->data[0];
            $this->boletim_id = $this->data[0]['boletim_id'];
            $this->assign('bolemat_boletim', "$this->boletim_id");
            $this->assignAll();
        }

        $cond = "bolemat_boletim = $this->boletim_id AND
                 bolemat_professor = $this->professor_id AND 
                 bolemat_serie = $this->sub AND 
                 bolemat_cliente = $this->aluno_id AND
                 bolemat_disciplina = $this->mat 
                ";

        $this->select()->from('bolemat')->where("$cond")->execute();
        if (!$this->result()) {
            $f = array('bolemat_cliente', 'bolemat_professor', 'bolemat_disciplina', 'bolemat_ano', 'bolemat_boletim', 'bolemat_serie');
            $v = array($this->aluno_id, $this->professor_id, $this->mat, $this->ano, $this->boletim_id, $this->sub);
            $this->insert('bolemat')->fields($f)->values($v)->execute();
            $this->bolemat_id = mysql_insert_id();
        } else {
            $this->assignAll();
            $this->bolemat_id = $this->data[0]['bolemat_id'];
        }
        //$this->redirect( "$this->baseUri/professor/boletim/turma/$this->sub/disciplina/$this->mat/aluno/$this->aluno_id/atualizar-gerado/" );
    }

    public function boletimAtualizar() {
        if ($this->postIsValid(array('aluno' => 'string'))) {
            $boletim_id = $this->postGetValue('boletim_id');
            $bolemat_boletim = $this->postGetValue('bolemat_boletim');
            $bolemat_id = $this->postGetValue('bolemat_id');
            $this->mat = $this->postGetValue('mat');
            $this->aluno_id = $this->postGetValue('aluno');
            $this->sub = $this->postGetValue('sub');
            $this->postIndexAdd('bolemat_cliente', $this->postGetValue('aluno'));
            $this->postIndexAdd('bolemat_disciplina', $this->postGetValue('mat'));
            $this->postIndexAdd('bolemat_professor', $this->professor_id);
            $this->postIndexAdd('bolemat_serie', $this->postGetValue('sub'));
            $this->postIndexDrop('aluno');
            $this->postIndexDrop('sub');
            $this->postIndexDrop('mat');
            $this->postIndexDrop('bolemat_boletim');
            $this->postIndexDrop('bolemat_id');
            //$this->postBlankDrop();



            $this->update('bolemat')->set()->where("bolemat_id = $bolemat_id")->execute();
            //echo $this->query;exit;
            $ret = "$this->baseUri/professor/boletim/turma/$this->sub/disciplina/$this->mat/aluno/$this->aluno_id/process-ok/";
            $this->redirect($ret);
        }
    }

    public function boletimImprimir() {
        if (isset($this->uri_segment[2])) {
            $this->cliente_id = $this->uri_segment[2];
            $this->tpl('admin/boletim_serie.html');
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
                        $t .= '<tr> <td> <p><strong>Matrícula: </strong>' . $this->cliente_matricula . ' </p></td> ';
                        $t .= '<td> <p><strong>Nome do Aluno: </strong> ' . $this->cliente_nome . ' </p></td> ';
                        $t .= '<td> <p><strong>Curso: </strong>' . $this->sub_title . ' | ' . $this->categoria_title . '</p></td> ';
                        $t .= '</tr>';
                        $t .= '</tbody>';
                        $t .= '<tfoot></tfoot>';
                        $t .= '</table><br/>';

                        $t .= '<table cellpadding="0" cellspacing="0" border="0"  class="table">';
                        $t .= '<thead>';
                        
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
                        $t .= '</table><br/>';
                        $hora = date('d-m-Y H:i');
                        $t .= '
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
    }

    public function _boletimImprimir() {
        $this->tpl('public/aluno_boletim_imprimir.html');
        if (isset($this->uri_segment[2])) {
            $this->aluno_id = $this->uri_segment[2];
            $this->select()
                    ->from('boletim')
                    ->join('bolemat', 'bolemat_boletim = boletim_id', 'INNER')
                    ->join('sub', 'sub_id = bolemat_serie', 'INNER')
                    ->join('categoria', 'categoria_id = sub_categoria', 'INNER')
                    ->join('disciplina', 'bolemat_disciplina = disciplina_id', 'INNER')
                    ->join('cliente', 'bolemat_cliente = cliente_id', 'INNER')
                    ->where("bolemat_cliente = $this->aluno_id AND bolemat_ano = '$this->ano'")
                    ->execute();
            if ($this->result()) {
                $this->assignAll();
                $this->fetch('r', $this->data);
            }
        }
        $this->render();
    }

    public function pageError() {
        
    }

}

/*end file*/