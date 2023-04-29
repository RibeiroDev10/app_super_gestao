<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SiteContato;
use App\MotivoContato;

class ContatoController extends Controller
{
    public function contato(Request $request) {

        $motivo_contatos = MotivoContato::all();

        return view('site.contato', ['titulo' => 'Contato (teste)', 'motivo_contatos' => $motivo_contatos]);
    }

    public function salvar(Request $request) {

        $regras = [
            'nome' => 'required|min:3|max:40|unique:site_contatos',
            'telefone' => 'required',
            'email' => 'email',
            'motivo_contatos_id' => 'required',
            'mensagem' => 'required|max:2000'
        ];

        $feedback_regras = [
            'nome.min' => 'O campo nome precisa ter no mínimo 3 caracteres!',
            'nome.max' => 'O campo nome pode ter no máximo 40 caracteres!',
            'nome.unique' => 'Este nome já está em uso!',
            'mensagem.max' => 'A mensagem deve ter no máximo 2000 caracteres!',
            'motivo_contatos_id.required' => 'Informe um motivo!',

            'email' => 'O email informado não é válido!',
            'required' => 'O campo :attribute deve ser preenchido!'
        ];

        //realizar a validação dos dados do formulário recebidos no request
        $request->validate($regras, $feedback_regras);

        SiteContato::create($request->all());

        return redirect()->route('site.index');
    }
}