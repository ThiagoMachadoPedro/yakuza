<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PostModel;
use App\Models\User;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;


class UserController extends Controller
{




          public function index(Request $request)
          {
                    $access_level = Auth::check() ? Auth::user()->access_level : null;

                    $query = User::orderBy("created_at", "desc");

                    if ($request->has('search')) {
                              $query->where('name', 'like', '%' . $request->input('search') . '%')
                                        ->orWhere('nick', 'like', '%' . $request->input('search') . '%');
                    }

                    $users = $query->paginate(8);

                    return view("user.index", ["users" => $users, "access_level" => $access_level]);
          }






          /**
           * Show the form for creating a new resource.
           */
          public function create()
          {
                    $users = User::orderBy('name', 'ASC')->get();
                    return view('user.create', ['users' => $users]);
          }

          /**
           * Store a newly created resource in storage.
           */


          public function store(Request $request)
          {
                    try {
                              $validatedData = $request->validate([
                                        'name' => 'required|string|max:255',
                                        'nick' => 'required|string|max:255',
                                        'email' => 'required|string|email|max:255|unique:users',
                                        'password' => 'required|string|min:6',
                                        'imageUser' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                              ]);

                              // Processar o upload da imagem
                              if ($request->hasFile('imageUser')) {
                                        $imagePath = $request->file('imageUser')->store('/images');
                              } else {
                                        $imagePath = null;
                              }

                              // Criar o usuário
                              $user = new User();
                              $user->name = $validatedData['name'];
                              $user->nick = $validatedData['nick'];
                              $user->email = $validatedData['email'];
                              $user->password = bcrypt($validatedData['password']);
                              $user->imageUser = $imagePath;

                              $user->save();

                              Auth::login($user);

                              return redirect()->route('post-index')->with('success', 'Usuário cadastrado com sucesso!');
                    } catch (ValidationException $e) {
                              if ($e->errors()['email'][0] === 'The email has already been taken.') {
                                        return back()->withInput()->with('error', 'O e-mail informado já está sendo usado por outro usuário.');
                              }

                              return back()->withInput()->with('error', 'Erro ao salvar usuário, e-mail já existe na base de dados!');
                    } catch (Exception $e) {
                              Log::error('Erro ao salvar usuário: ' . $e->getMessage());
                              return back()->withInput()->with('error', 'Erro ao salvar usuário.');
                    }
          }



          /**
           * Display the specified resource.
           */
          public function show($id)
          {
                    $user = User::findOrFail($id);
                    $posts = PostModel::where('id_user', $id)->orderBy('created_at', 'desc')->paginate(6);
                    return view('user.visualizar', compact('user' , 'posts'));
          }
          /**
           * Show the form for editing the specified resource.
           */
          public function edit($id)
          {
                    $user = User::findOrFail($id);
                    $access_level = Auth::check() ? Auth::user()->access_level : null;
                    return view("user.edit", ["user" => $user, "access_level" => $access_level]);
          }


          /**
           * Update the specified resource in storage.
           */
          public function update(Request $request, string $id)
          {
                    try {
                              $user = User::find($id);

                              if (!$user) {
                                        return redirect()->route('user-index')->with('error', 'Usuário não encontrado.');
                              }

                              $validatedData = $request->validate([
                                        'name' => 'required|string|max:255',
                                        'nick' => 'required|string|max:255',
                                        'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
                                        'imageUser' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                              ]);

                              // Processar o upload da imagem
                              if ($request->hasFile('imageUser')) {
                                        $imagePath = $request->file('imageUser')->store('public/images');
                                        $user->imageUser = $imagePath;
                              }

                              $user->name = $validatedData['name'];
                              $user->nick = $validatedData['nick'];
                              $user->email = $validatedData['email'];

                              // Verifica se o campo access_level foi enviado no request
                              if ($request->has('access_level')) {
                                        $user->access_level = $request->input('access_level');
                              }

                              $user->save();

                              return redirect()->route('user-index')->with('success', 'Usuário atualizado com sucesso!');
                    } catch (Exception $e) {
                              Log::error('Erro ao atualizar usuário: ' . $e->getMessage());
                              return back()->withInput()->with('error', 'Erro ao atualizar usuário.');
                    }
          }


          /**
           * Remove the specified resource from storage.
           */
          public function destroy(string $id)
          {
                    try {
                              $user = User::find($id);

                              if (!$user) {
                                        return redirect()->route('user-index')->with('error', 'Usuário não encontrado.');
                              }

                              $user->delete();

                              return redirect()->route('user-index')->with('success', 'Usuário excluído com sucesso!');
                    } catch (Exception $e) {
                              Log::error('Erro ao excluir usuário: ' . $e->getMessage());
                              return back()->withInput()->with('error', 'Erro ao excluir usuário.');
                    }
          }




}
