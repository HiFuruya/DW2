<?php

use Illuminate\Support\Facades\Route;
use \Illuminate\Http\Request;

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

    $alunos = "<ul>";
    if (preg_match('/^[1-9][0-9]*$/', $total)) {
        $dados = alunos();
        
    
        if ($total <= count($dados) && $total > 0) {
            $cont = 0;

            foreach($dados as $chave => $aux){
                if ($cont < $total) {
                    $alunos .= "<li>".$chave." - ".$dados[$chave]['nome']."</li>";
                }
                $cont++;
            }
        }else{
            $alunos .= "<li>Impossível retornar o valor digitado</li>";
        }
    }else{
        $alunos .= "<li>O valor digitado não é inteiro</li>";
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
                    $aluno .= "<li>".$chave." - ".$dados[$chave]['nome']."</li>";
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
        if (trim($dados[$chave]['nome']) == trim($val)) {
            $aluno .= "<li>".$chave." - ".$dados[$chave]['nome']."</li>";
            break;
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

    if (preg_match('/^[1-9][0-9]*$/', $val)) {
        $alunos = "<table> <thead><th>Matricula</th> <th>Aluno</th> <th>Nota</th> </thead> <tbody align = center>";

        $dados = alunos();
        
        if ($val <= count($dados) && $val > 0) {

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
        }else{
            $alunos = "<li>Impossível retornar o valor digitado</li>";
        }
    }else{
        $alunos = "<li>O valor digitado não é válido</li>";
    }

    return $alunos;
});

Route::get('/nota/lancar/{nota}/{matricula}/{nome?}', function($nota, $matricula, $nome=null){
    $dados = alunos();

    if (empty($nome)) {
        foreach($dados as $valor => $aux){
            if ($valor == $matricula) {
                $dados[$valor]['nota'] = $nota;
            }
        }
    }else{
        foreach($dados as $valor => $aux){
            if (trim($dados[$valor]['nome']) == trim($nome)) {
                $dados[$valor]['nota'] = $nota;
            }
        }
    }
    
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

// Route::get('/nota/conceito/{A}/{B}/{C}', function($A,$B,$C){
//     $dados = alunos();

//     foreach ($dados as $key => $value) {
//         if ($dados[$key]['nota'] >= $A) {
//             $dados[$key]['nota'] = 'A';
//         }elseif($dados[$key]['nota'] >= $B) {
//             $dados[$key]['nota'] = 'B';
//         }elseif($dados[$key]['nota'] >= $C) {
//             $dados[$key]['nota'] = 'C';
//         }else{
//             $dados[$key]['nota'] = 'D';
//         }
//     }
//     var_dump($dados);
//     $alunos = "<table> <thead><th>Matricula</th> <th>Aluno</th> <th>Nota</th> </thead> <tbody align = center>";

//     foreach($dados as $chave => $aux){
//         $alunos .= "<tr><td>".$chave."</td>";
//         foreach($aux as $chave => $valor){
//             $alunos .= "<td>".$valor."</td>";
//         }
//         $alunos .= "</tr>";
//     }

//     $alunos .= "</tbody>";

//     return $alunos;
// });

Route::post('/nota/conceito', function(Request $request){
    $dados = alunos();

    foreach ($dados as $key => $value) {
        if ($dados[$key]['nota'] >= $request->A) {
            $dados[$key]['nota'] = 'A';
        }elseif($dados[$key]['nota'] >= $request->B) {
            $dados[$key]['nota'] = 'B';
        }elseif($dados[$key]['nota'] >= $request->C) {
            $dados[$key]['nota'] = 'C';
        }else{
            $dados[$key]['nota'] = 'D';
        }
    }
    
   /* $alunos = "<table> <thead><th>Matricula</th> <th>Aluno</th> <th>Nota</th> </thead> <tbody align = center>";

    foreach($dados as $chave => $aux){
        $alunos .= "<tr><td>".$chave."</td>";
        foreach($aux as $chave => $valor){
            $alunos .= "<td>".$valor."</td>";
        }
        $alunos .= "</tr>";
    }
    */
    dd($dados);
   // $alunos .= "</tbody>";

    //return $alunos;

    // foreach($dados as $chave => $aux){
    //     echo
    //     foreach($aux as $chave => $valor){
    //         $alunos .= "<td>".$valor."</td>";
    //     }
    //     $alunos .= "</tr>";
    // }
});