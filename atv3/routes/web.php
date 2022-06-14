<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

function alunos()
{
    $dados = array(
        "1" => array(
            "nome" => "Ana",
            "nota" => "9"
        ),
        "2" => array(
            "nome" => "Bruno",
            "nota" => "2"
        ),
        "3" => array(
            "nome" => "Carol",
            "nota" => "8"
        ),
        "4" => array(
            "nome" => "Danilo",
            "nota" => "6"
        ),
        "5" => array(
            "nome" => "Ellen",
            "nota" => "4"
        )
    );
    return $dados;
}

Route::get('/', function () {
    return view('welcome');
});

Route::get('/aluno', function () {

    $dados = alunos();
    
    $alunos = "<ul>";

    foreach($dados as $chave => $aux){
        $alunos .= "<li>".$chave." - ";
        foreach($aux as $chave => $valor){
            if (trim($chave) == "nome") {
                $alunos .= $valor."</li>";
                break;
            }
        }
    }

    return $alunos;
});

Route::get('/aluno/limite/{total}', function ($total) {

    $dados = alunos();
    
    $alunos = "<ul>";

    if ($total <= count($dados) && $total > 0) {
        $cont = 0;
        foreach($dados as $chave => $aux){
            if ($cont < $total) {
                $alunos .= "<li>".$chave." - ";
                foreach($aux as $chave => $valor){
                    if (trim($chave) == "nome") {
                        $alunos .= $valor."</li>";
                        break;
                    }
                }
                $cont++;
            }
        }
    }else{
        $alunos .= "<li>Impossível retornar o valor digitado</li>";
    }
    return $alunos;
});

Route::get('/aluno/matricula/{val}', function ($val) {

    $dados = alunos();
    $aluno = "<ul>";
    if ($val < 1 || $val > count($dados)) {
        $aluno .= "<li>NÃO ENCONTRADO</li>";
    }else {
        if ($val <= count($dados)) {
            foreach($dados as $chave => $nome) {
                if ($chave == $val) {
                    $aluno .= "<li>".$chave." - ";
                    foreach($nome as $chave => $valor){
                        if (trim($chave) == "nome") {
                            $aluno .= $valor."</li>";
                            break;
                        }
                    }            
                }
            }
        }
    }

    return $aluno;
});

Route::get('/aluno/nome/{val}', function ($val) {

    $dados = alunos();

    $aluno = "<ul>";

    foreach($dados as $chave => $aux) {
        foreach($aux as $nome => $valor){
            if (trim($nome) == "nome") {
                if (trim($valor) == trim($val)) {
                    $aluno .= "<li>".$chave." - ".$val."</li>";
                    break;
                }
            }
        }            
    }

    if (trim($aluno) == "<ul>") {
        $aluno .= "<li>NÃO ENCONTRADO</li>";
    }

    return $aluno;
});

Route::get('/nota', function () {

    $dados = alunos();
    
    $alunos = "<table> <thead><th>Matricula</th> <th>Aluno</th> <th>Nota</th> </thead> <tbody align = center>";

    foreach($dados as $chave => $aux){
        $alunos .= "<tr><td>".$chave."</td>";
        foreach($aux as $chave => $valor){
            $alunos .= "<td>".$valor."</td>";
        }
        $alunos .= "</tr>";
    }

    $alunos .= "</tbody>";

    return $alunos;
});

Route::get('/nota/limite/{val}', function ($val) {

    $dados = alunos();
    
    $alunos = "<table> <thead><th>Matricula</th> <th>Aluno</th> <th>Nota</th> </thead> <tbody align = center>";

    $cont = 0;
    foreach($dados as $chave => $aux){
        if ($cont < $val) {
            $alunos .= "<tr><td>".$chave."</td>";
            foreach($aux as $chave => $valor){
                $alunos .= "<td>".$valor."</td>";
            }
            $alunos .= "</tr>";
        }
        $cont++;
    }

    $alunos .= "</tbody>";

    return $alunos;
});

Route::get('/nota/lancar/{nota}/{matricula}/{nome}', function($nota, $matricula, $nome){
    
});
