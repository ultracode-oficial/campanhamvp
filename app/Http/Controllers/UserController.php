<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('name','!=','Victor Mussel')->get();
        return view('pages.usuario.index', compact('users'));
    }

    public function create()
    {

        return view('pages.usuario.create');
    }

    public function store()
    {

        $data = request();

        $user = new User;

        $user->name  = $data->name;
        $user->email = $data->email;
        $user->nivel = $data->nivel;
        $user->password = 'campanha123';
        
        // dd($user);
        $user->save();

        return redirect('/user');
    }

    public function AlteraSenha()
	{
		$usuario = Auth::user();
	
		return view('auth.altera_senha',compact('usuario'));    

		
	}

	public function SalvarSenha(Request $request)
	{
	
        // dd($request->all());
		// Validar
		$this->validate($request, [
			'password_atual'        => 'required',
			'password'              => 'required|min:6|confirmed',
			'password_confirmation' => 'required|min:6'
		]);

		// Obter o usuário
		$usuario = User::find(Auth::user()->id);

		if (Hash::check($request->password_atual, $usuario->password))
		{

			$usuario->update(['password' => $request->password]);            

			return redirect('/home')->with('sucesso','Senha alterada com sucesso.');
		}else{

			return back()->withErrors('Senha atual não confere');
		}

	}
}
