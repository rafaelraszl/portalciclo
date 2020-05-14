<?php

class Relatorio extends PHPFrodo {

    public $login = null;
    public $user_login;
    public $user_id;
    public $user_name;
    public $cliente_id;
    public $cliente_cpf;
    public $cliente_nome;
    public $cliente_email;
    public $perPage = 30;

    public function __construct() {
        parent::__construct();
        $sid = new Session;
        $sid->start();
        if (!$sid->check() || $sid->getNode('user_id') <= 0) {
            $this->redirect("$this->baseUri/admin/login/logout/");
            exit;
        }
        $this->select()
                ->from('config')
                ->execute();
        if ($this->result()) {
            $this->config = (object) $this->data[0];
            $this->map($this->data[0]);
            $this->assignAll();
        }
        if (isset($this->uri_segment) && in_array('process-ok', $this->uri_segment)) {
            $this->assign('msgOnload', 'notify("<h1>Procedimento realizado com sucesso</h1>")');
        }
        $this->user_login = $sid->getNode('user_login');
        $this->user_id = $sid->getNode('user_id');
        $this->user_name = $sid->getNode('user_name');
        $this->assign('user_name', $this->user_name);
        setlocale(LC_ALL, 'pt_BR', 'ptb');
        $this->assign('mesExtenso', ucfirst(gmstrftime("%B")));
        $this->ano = date('Y');
    }

    public function welcome() {
        $this->tpl('admin/relatorio.html');
        $this->fillCliente();
        $this->fillAno();
        $this->fillSerie();
        $this->render();
    }

    public function fillCliente() {
        $this->select()
                ->from('cliente')
                ->orderby('cliente_nome')
                ->execute();
        if ($this->result()) {
            $this->fetch('cl', $this->data);
        }
    }

    public function fillAno() {
        $y = array();
        $start = $this->config_site_ano;
        $current = intval(date('Y'));
        for ($i = $start; $i <= $current + 1; $i++) {
            array_push($y, array('ano' => $i));
        }
        $this->fetch('Y', $y);
    }

    public function imprimir() {
        if (isset($this->uri_segment[2])) {
            $this->cliente_id = $this->uri_segment[2];
            $this->tpl('admin/relatorio_ficha.html');
            $this->select()
                    ->from('cliente')
                    ->join('sub', 'sub_id = cliente_sub', 'INNER')
                    ->join('categoria', 'categoria_id = sub_categoria', 'INNER')
                    ->where("cliente_id = $this->cliente_id")
                    ->execute();
            if ($this->result()) {
                $this->preg(array('/2/', '/1/'), array('Feminino', 'Masculino'), 'cliente_sexo');
                $this->assignAll();
            } else {
                $this->redirect("$this->baseUri/admin/cliente/");
            }
        }
        $ano = date('Y');
        if (isset($this->uri_segment[3])) {
            $ano = $this->uri_segment[3];
            $this->select()
                    ->from('mensal')
                    ->join('cliente', 'mensal_cliente = cliente_id', 'INNER')
                    ->where("mensal_ano = '$ano' and mensal_cliente = $this->cliente_id")
                    ->execute();
            $this->map($this->data[0]);
            $m = "<h1>Mensalidades de $ano</h1>";
            $m .= "<p><b>Janeiro:</b> $this->mensal_jan</p>";
            $m .= "<p><b>Fevereiro:</b> $this->mensal_fev</p>";
            $m .= "<p><b>Março:</b> $this->mensal_mar</p>";
            $m .= "<p><b>Abril:</b> $this->mensal_abr</p>";
            $m .= "<p><b>Maio:</b> $this->mensal_mai</p>";
            $m .= "<p><b>Junho:</b> $this->mensal_jun</p>";
            $m .= "<p><b>Julho:</b> $this->mensal_jul</p>";
            $m .= "<p><b>Agosto:</b> $this->mensal_ago</p>";
            $m .= "<p><b>Setembro:</b> $this->mensal_set</p>";
            $m .= "<p><b>Outubro:</b> $this->mensal_out</p>";
            $m .= "<p><b>Novembro:</b> $this->mensal_nov</p>";
            $m .= "<p><b>Dezembro:</b> $this->mensal_dez</p>";
            $total = number_format(($this->mensal_jan + $this->mensal_fev + $this->mensal_mar + $this->mensal_abr + $this->mensal_mai +
                    $this->mensal_jun + $this->mensal_jul + $this->mensal_ago + $this->mensal_set + $this->mensal_out +
                    $this->mensal_nov + $this->mensal_dez), 2, ',', '.');
            $m .= "<p><b class=\"b-top\">Total:</b> $total</p>";

            $m = "<table class=\"no-border-bottom\">";
            $m .= "<tr>";
            $m .= "<td><strong>Aluno</strong></td>";
            $m .= "<td>$this->cliente_nome</td>";
            $m .= "</tr>";
            $m .= "<td><strong>Matrícula</strong></td>";
            $m .= "<td>$this->cliente_matricula</td>";
            $m .= "</tr>";
            $m .= "</table>";
            $m .= "<table class=\"no-border-top no-border-bottom\">";
            $m .= "<tr>";
            $m .= "<th><h1>Mensalidades de $ano</h1></th>";
            $m .= "</tr>";
            $m .= "</table>";
            $m .= "<table>";
            $m .= "<tr><td>Janeiro</td><td> R$ $this->mensal_jan</td></tr>";
            $m .= "<tr><td>Fevereiro</td><td>R$ $this->mensal_fev</td></tr>";
            $m .= "<tr><td>Março</td><td>R$ $this->mensal_mar</td></tr>";
            $m .= "<tr><td>Abril</td><td>R$ $this->mensal_abr</td></tr>";
            $m .= "<tr><td>Maio</td><td>R$ $this->mensal_mai</td></tr>";
            $m .= "<tr><td>Junho</td><td>R$ $this->mensal_jun</td></tr>";
            $m .= "<tr><td>Julho</td><td>R$ $this->mensal_jul</td></tr>";
            $m .= "<tr><td>Agosto</td><td>R$ $this->mensal_ago</td></tr>";
            $m .= "<tr><td>Setembro</td><td>R$ $this->mensal_set</td></tr>";
            $m .= "<tr><td>Outubro</td><td>R$ $this->mensal_out</td></tr>";
            $m .= "<tr><td>Novembro</td><td>R$ $this->mensal_nov</td></tr>";
            $m .= "<tr><td>Dezembro</td><td>R$ $this->mensal_dez</td></tr>";
            $m .= "</table>";

            $this->assign('mensalidades', $m);
            $this->assign('showA', 'hide');
            $this->assign('showT', 'hide');
        }
        $this->render();
    }

    public function total() {
        $this->tpl('admin/relatorio_ficha.html');
        $ano = date('Y');
        if (isset($this->uri_segment[2])) {
            $ano = $this->uri_segment[2];
        }

        $wall = "";
        if (!isset($this->uri_segment[3])) {
            $wall = "w-all";
        }
        $m = "<table class=\"no-border-bottom $wall all-w\">";
        $m .= "<tr>";
        $m .= "<th><h1>Mensalidades de {mes} de $ano</h1></th>";
        $m .= "</tr>";
        $m .= "</table>";
        $m .= "<table class=\"no-border-bottom $wall\">";
        $m .= "<tr>";
        $m .= "<td class=\"bold\">Aluno</td>";
        $m .= "<td class=\"bold\">Matrícula</td>";
        if (isset($this->uri_segment[3])) {
            $m .= "<td><strong>Valor</strong></td>";
        } else {
            $m .= "<td class=\"bold\">Janeiro</td>";
            $m .= "<td class=\"bold\">Fevereiro</td>";
            $m .= "<td class=\"bold\">Março</td>";
            $m .= "<td class=\"bold\">Abril</td>";
            $m .= "<td class=\"bold\">Maio</td>";
            $m .= "<td class=\"bold\">Junho</td>";
            $m .= "<td class=\"bold\">Julho</td>";
            $m .= "<td class=\"bold\">Agosto</td>";
            $m .= "<td class=\"bold\">Setembro</td>";
            $m .= "<td class=\"bold\">Outubro</td>";
            $m .= "<td class=\"bold\">Novembro</td>";
            $m .= "<td class=\"bold\">Dezembro</td>";
        }
        $m .= "</tr>";

        $f = "*";
        if (isset($this->uri_segment[3]) && $this->uri_segment[3] != 'p' && $this->uri_segment[3] != 'n' && $this->uri_segment[3] != 't') {
            $f = "mensal_" . $this->uri_segment[3] . ", cliente_matricula, cliente_id,cliente_nome";
        }

        if (isset($this->uri_segment[4])) {
            $filtro = $this->uri_segment[4];
        }
        $mhead = $m;

        $totalF = 0;
        $this->select($f)
                ->from('mensal')
                ->join('cliente', 'mensal_cliente = cliente_id', 'INNER')
                ->where("mensal_ano = '$ano'")
                ->execute();
        $this->preg(array('/2/', '/1/'), array('Feminino', 'Masculino'), 'cliente_sexo');
        $all = $this->data;

        $page = 0;
        foreach ($all as $c) {
            if ($page == $this->perPage) {
                $m .= "</table>";
                $m .= '<div class="page"></div>';
                $m .= $mhead;
                $page = 0;
            }
            $this->map($c);
            $mn = "";
            $m .= "<tr>";
            $m .="<td>$this->cliente_nome </td>";
            $m .="<td>$this->cliente_matricula</td>";

            if (isset($this->mensal_jan)) {
                $mn = "Janeiro";
                $m .= "<td>$this->mensal_jan</td>";
            }
            if (isset($this->mensal_fev)) {
                $m .= "<td>$this->mensal_fev</td>";
                $mn = "Fevereiro";
            }
            if (isset($this->mensal_mar)) {
                $m .= "<td>$this->mensal_mar</td>";
                $mn = "Março";
            }
            if (isset($this->mensal_abr)) {
                $m .= "<td>$this->mensal_abr</td>";
                $mn = "Abril";
            }
            if (isset($this->mensal_mai)) {
                $m .= "<td>$this->mensal_mai</td>";
                $mn = "Maio";
            }
            if (isset($this->mensal_jun)) {
                $m .= "<td>$this->mensal_jun</td>";
                $mn = "Junho";
            }
            if (isset($this->mensal_jul)) {
                $m .= "<td>$this->mensal_jul</td>";
                $mn = "Julho";
            }
            if (isset($this->mensal_ago)) {
                $m .= "<td>$this->mensal_ago</td>";
                $mn = "Agosto";
            }
            if (isset($this->mensal_set)) {
                $m .= "<td> $this->mensal_set</td>";
                $mn = "Setembro";
            }
            if (isset($this->mensal_out)) {
                $m .= "<td> $this->mensal_out</td>";
                $mn = "Otubro";
            }
            if (isset($this->mensal_nov)) {
                $m .= "<td> $this->mensal_nov</td>";
                $mn = "Novembro";
            }
            if (isset($this->mensal_dez)) {
                $m .= "<td> $this->mensal_dez</td>";
                $mn = "Dezembro";
            }
            $m .= "</tr>";

            //$m .="<p><strong>Aluno:</strong> $this->cliente_nome | <strong>Matrícula:</strong> $this->cliente_matricula<p/>";

            $arrSoma = array();
            if (isset($this->mensal_jan)) {
                $arrSoma[] = $this->mensal_jan;
            }
            if (isset($this->mensal_fev)) {
                $arrSoma[] = $this->mensal_fev;
            }
            if (isset($this->mensal_mar)) {
                $arrSoma[] = $this->mensal_mar;
            }
            if (isset($this->mensal_abr)) {
                $arrSoma[] = $this->mensal_abr;
            }
            if (isset($this->mensal_mai)) {
                $arrSoma[] = $this->mensal_mai;
            }
            if (isset($this->mensal_jun)) {
                $arrSoma[] = $this->mensal_jun;
            }
            if (isset($this->mensal_jul)) {
                $arrSoma[] = $this->mensal_jul;
            }
            if (isset($this->mensal_ago)) {
                $arrSoma[] = $this->mensal_ago;
            }
            if (isset($this->mensal_set)) {
                $arrSoma[] = $this->mensal_set;
            }
            if (isset($this->mensal_out)) {
                $arrSoma[] = $this->mensal_out;
            }
            if (isset($this->mensal_nov)) {
                $arrSoma[] = $this->mensal_nov;
            }
            if (isset($this->mensal_dez)) { {
                    $arrSoma[] = $this->mensal_dez;
                }
            }
            $total = 0;
            for ($i = 0; $i <= count($arrSoma) - 1; $i++) {
                $total += $arrSoma[$i];
                $totalF += $arrSoma[$i];
            }
            $total = number_format($total, 2, ',', '.');
            if (!isset($this->uri_segment[3])) {
                //$m .= "<p><b class=\"b-top\">Total:</b> $total</p><br />";
            }
            $page++;
        }
        $m .="</table>";

        $totalF = number_format($totalF, 2, ',', '.');
        $m .= "<table class=\"no-border-top $wall\">";
        $m .= "<tr>";
        $m .= "<th class=\"a-right\">Total: $totalF</th>";
        $m .= "</tr>";
        $m .= "</table>";

        // echo $this->uri_segment[3];exit;
        if (isset($this->uri_segment[3])) {
            $m = preg_replace('/{mes}/', "$mn", $m);
        } else {
            $m = preg_replace('/de {mes}/', "", $m);
        }
        $this->assign('mensalidades', $m);
        $this->assign('showA', 'hide');
        $this->assign('showT', 'hide');


        $this->render();
    }

    public function totalN() {
        $this->tpl('admin/relatorio_ficha.html');
        $ano = date('Y');
        if (isset($this->uri_segment[2])) {
            $ano = $this->uri_segment[2];
        }
        $f = "*";
        if (isset($this->uri_segment[3]) && $this->uri_segment[3] != 'p' && $this->uri_segment[3] != 'n' && $this->uri_segment[3] != 't') {
            $f = "mensal_" . $this->uri_segment[3];
        }

        if (isset($this->uri_segment[4])) {
            $filtro = $this->uri_segment[4];
        }
        if ($filtro == 'p') {
            $sit = "(PAGOS)";
        } elseif ($filtro == 'n') {
            $sit = "(PENDENTES)";
        }
        $m = "<table class=\"no-border-bottom \">";
        $m .= "<tr>";
        $m .= "<th><h1>Mensalidades de {mes} $ano $sit</h1></th>";
        $m .= "</tr>";
        $m .= "</table>";
        $m .= "<table class=\" no-border-bottom\">";
        $m .= "<tr>";
        $m .= "<td class=\"bold\">Aluno</td>";
        $m .= "<td class=\"bold\">Matrícula</td>";
        if ($filtro == 'p') {
            $m .= "<td class=\"bold\"> Valor</td>";
        }
        $m .= "</tr>";

        $mhead = $m;
        $totalF = 0;
        $this->select()
                ->from('mensal')
                ->join('cliente', 'mensal_cliente = cliente_id', 'INNER')
                ->where("mensal_ano = '$ano'")
                ->execute();
        $this->preg(array('/2/', '/1/'), array('Feminino', 'Masculino'), 'cliente_sexo');
        $all = $this->data;
        $page = 0;
        foreach ($all as $c) {
            $this->map($c);
            $arrSoma = array();
            if (isset($c[$f])) {
                if ($filtro == 'p' && $c[$f] >= 1) {
                    if ($page == $this->perPage) {
                        $m .= "</table>";
                        $m .= '<div class="page"></div>';
                        $m .= $mhead;
                        $page = 0;
                    }
                    $m .= "<tr>";
                    $m .="<td>$this->cliente_nome </td>";
                    $m .="<td>$this->cliente_matricula</td>";
                    $m .= "<td>" . $c[$f] . "</td>";
                    $m .= "</tr>";
                    if (isset($c[$f])) {
                        $arrSoma[] = $c[$f];
                    }
                    $total = 0;
                    for ($i = 0; $i <= count($arrSoma) - 1; $i++) {
                        $total += $arrSoma[$i];
                        $totalF += $arrSoma[$i];
                    }
                    $total = number_format($total, 2, ',', '.');
                }
                if ($filtro == 'n' && $c[$f] <= 0) {
                    if ($page == $this->perPage) {
                        $m .= "</table>";
                        $m .= '<div class="page"></div>';
                        $m .= $mhead;
                        $page = 0;
                    }
                    $m .= "<tr>";
                    $m .="<td>$this->cliente_nome </td>";
                    $m .="<td>$this->cliente_matricula</td>";
                    $m .= "</tr>";
                }
                $page++;
            }
        }
        $totalF = number_format($totalF, 2, ',', '.');
        $m .= "</table>";
        if ($filtro == 'p') {
            $m .= "<table class=\"no-border-top\">";
            $m .= "<tr>";
            $m .= "<th class=\"a-right\">Total: $totalF</th>";
            $m .= "</tr>";
            $m .= "</table>";
        }
        if (isset($this->mensal_jan)) {
            $mn = "Janeiro";
        }
        if (isset($this->mensal_fev)) {
            $mn = "Fevereiro";
        }
        if (isset($this->mensal_mar)) {
            $mn = "Março";
        }
        if (isset($this->mensal_abr)) {
            $mn = "Abril";
        }
        if (isset($this->mensal_mai)) {
            $mn = "Maio";
        }
        if (isset($this->mensal_jun)) {
            $mn = "Junho";
        }
        if (isset($this->mensal_jul)) {
            $mn = "Julho";
        }
        if (isset($this->mensal_ago)) {
            $mn = "Agosto";
        }
        if (isset($this->mensal_set)) {
            $mn = "Setembro";
        }
        if (isset($this->mensal_out)) {
            $mn = "Otubro";
        }
        if (isset($this->mensal_nov)) {
            $mn = "Novembro";
        }
        if (isset($this->mensal_dez)) {
            $mn = "Dezembro";
        }

        if (isset($this->uri_segment[3]) && $this->uri_segment[3] == 'jan')
            $mn = "Janeiro";
        if (isset($this->uri_segment[3]) && $this->uri_segment[3] == 'fev')
            $mn = "Fevereiro";
        if (isset($this->uri_segment[3]) && $this->uri_segment[3] == 'mar')
            $mn = "Março";
        if (isset($this->uri_segment[3]) && $this->uri_segment[3] == 'abr')
            $mn = "Abril";
        if (isset($this->uri_segment[3]) && $this->uri_segment[3] == 'mai')
            $mn = "Maio";
        if (isset($this->uri_segment[3]) && $this->uri_segment[3] == 'jun')
            $mn = "Junho";

        if (isset($this->uri_segment[3]) && $this->uri_segment[3] == 'jul')
            $mn = "Julho";

        if (isset($this->uri_segment[3]) && $this->uri_segment[3] == 'ago')
            $mn = "Agosto";

        if (isset($this->uri_segment[3]) && $this->uri_segment[3] == 'set')
            $mn = "Setembro";

        if (isset($this->uri_segment[3]) && $this->uri_segment[3] == 'out')
            $mn = "Outubro";

        if (isset($this->uri_segment[3]) && $this->uri_segment[3] == 'nov')
            $mn = "Novembro";

        if (isset($this->uri_segment[3]) && $this->uri_segment[3] == 'dez')
            $mn = "Dezembro";


        $m = preg_replace('/{mes}/', "$mn de ", $m);
        $this->assign('mensalidades', $m);
        $this->assign('showA', 'hide');
        $this->assign('showT', 'hide');


        $this->render();
    }

    public function fillSerie() {
        $this->select()
                ->from('sub')
                ->orderby('sub_title')
                ->execute();
        if ($this->result()) {
            $this->fetch('s', $this->data);
        }
    }

    public function boletimSerie() {
        $this->tpl('admin/boletim_serie.html');
        if (isset($this->uri_segment[2])) {
            $this->sub_id = $this->uri_segment[2];
            $tt = '';

            $this->select()
                    ->from('sub')
                    ->join('cliente', 'cliente_sub = sub_id', 'INNER')
                    ->join('categoria', 'sub_categoria = categoria_id', 'INNER')
                    ->where("sub_id = $this->sub_id")
                    ->execute();
            if ($this->result()) {
                $all = $this->data;
                foreach ($all as $c) {
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
                        //$this->map( $this->data[0] );
                        $this->assignAll();
                        $data = $this->data;
                        //$t = '<div style="page-break-after:always !important;">';
                        $t = '<div class="table-break">';
                        $t .= '
                             <table  style="border:0px !important; margin-bottom:10px !important; width:85% !important">
                                <tr>
                                    <td style="border:0px !important;text-align:right"><img src="images/layout/topo2.png" /> </td>
                                </tr>
                         </table><br/>
                        ';
                        //$t = "<p><strong>Nome do Aluno:</strong> $this->cliente_nome | <strong>Matrícula:</strong> $this->cliente_matricula <br/>";
                        //$t .= "<strong>Série:</strong> $this->sub_title | <strong>Turno:</strong> $this->categoria_title</p>";
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
                        $t .= '<th class="thFundoCinza" >MEDIA</th>';
                        $t .= '<th class="thFundoCinza" >FALTAS</th>';
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
                        date_default_timezone_set('Etc/GMT+3');
                        $hora = date('d-m-Y H:i');
                        $t .= '
                         <p style="float:right;margin-right:10px;">' . $hora . ' </p><br/><br/>
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

    public function boletimAluno() {
        $this->tpl('admin/boletim_serie.html');
        if (isset($this->uri_segment[2])) {
            $this->cliente_id = $this->uri_segment[2];
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
                         </table><br/>
                        ';
                        $t .= '<table cellpadding="0" cellspacing="0" border="0"  class="table">';
                        $t .= '<thead>';

                        $t .= '</thead>';
                        $t .= '<tbody>';
                        $t .= '<tr> <td> <p><strong>Matricula: </strong>' . $this->cliente_matricula . ' </p></td> ';
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
                        $t .= '<th class="thFundoCinza" >PROVA I </th>';
                        $t .= '<th class="thFundoCinza" >FALTAS</th>';
                        $t .= '<th class="thFundoCinza" >PROVA II </th>';
                        $t .= '<th class="thFundoCinza" >FALTAS</th>';
                        $t .= '<th class="thFundoCinza" >PROVA III </th>';
                        $t .= '<th class="thFundoCinza" >FALTAS</th>';
                        $t .= '<th class="thFundoCinza" >PROVA IV</th>';
                        $t .= '<th class="thFundoCinza" >FALTAS</th>';
                        $t .= '<th class="thFundoCinza" >PROVA V</th>';
                        $t .= '<th class="thFundoCinza" >MEDIA</th>';
                        $t .= '<th class="thFundoCinza" >FALTAS</th>';
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
                        date_default_timezone_set('Etc/GMT+3');
                        $hora = date('d-m-Y H:i');
                        $t .= '
                         <p style="float:right;margin-right:10px;">' . $hora . ' </p><br/><br/>
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

}
