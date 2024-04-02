<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DestaqueModel;
use Auth;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Log;
use Storage;

class DestaqueController extends Controller
{
          /**
           * Display a listing of the resource.
           */
          public function index(Request $request)
          {
                    // pesquisa qual nivel de acesso para passar pra view
                    $access_level = Auth::check() ? Auth::user()->access_level : null;


                    $query = DestaqueModel::with('user')->orderBy("created_at", "desc");

                    if ($request->has('post')) {
                              $query->where('jogadores', 'like', '%' . $request->input('post') . '%');
                    }

                    if ($request->has('data')) {
                              $dateValue = $request->input('data');
                              if (!empty($dateValue)) {
                                        try {
                                                  $date = Carbon::createFromFormat('Y-m-d', $dateValue);
                                                  $query->whereDate('created_at', $date);
                                        } catch (Exception $e) {
                                                  // Tratar caso o valor de data não seja válido
                                                  // Por exemplo, redirecionar de volta com uma mensagem de erro
                                                  return redirect()->back()->with('error', 'Data inválida');
                                        }
                              }
                    }

                    $posts = $query->paginate(8);

                    return view("destaque.index", ["posts" => $posts, "access_level" => $access_level]);
          }


          public function create()
          {
                    return view("destaque.create");
          }

          /**
           * Store a newly created resource in storage.
           */
          public function store(Request $request)
          {
                    try {
                              $validatedData = $request->validate([
                                        'jogadores' => 'required|string|max:255',
                                        'destaque' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                                        'descricao' => 'required|string|max:255',

                              ]);

                              $user = Auth::user(); // Obter o usuário autenticado

                              $post = new DestaqueModel();
                              $post->jogadores = $validatedData['jogadores'];

                              // Processar o upload da imagem, se existir
                              if ($request->hasFile('destaque')) {
                                        $imagePath = $request->file('destaque')->store('destaque', 'public');
                                        $post->destaque = $imagePath;
                              }

                              $post->descricao = $validatedData['descricao'];
                              $post->id_user = $user->id;
                              $post->save();

                              return redirect()->route('destaque-index')->with('success', 'Post criado com sucesso!');
                    } catch (Exception $e) {
                              Log::error('Erro ao criar post: ' . $e->getMessage());
                              return back()->withInput()->with('error', 'Erro ao criar post.');
                    }
          }


          public function show(string $id)
          {
                    $post = DestaqueModel::findOrFail($id);
                    return view("destaque.visualizar", ["post" => $post]);
          }

          public function edit(string $id)
          {
                    $post = DestaqueModel::find($id);

                    if (!$post) {
                              return redirect()->route('destaque-index')->with('error', 'Post não encontrado.');
                    }

                    return view('destaque.edit', compact('post'));
          }
          public function update(Request $request, string $id)
          {
                    try {
                              $post = DestaqueModel::find($id);

                              if (!$post) {
                                        return redirect()->route('destaque-index')->with('error', 'Post não encontrado.');
                              }

                              $validatedData = $request->validate([
                                        'jogadores' => 'required|string|max:255',
                                        'descricao' => 'required|string|max:255',
                                        'destaque' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                              ]);

                              if ($request->hasFile('destaque')) {
                                        $imagePath = $request->file('destaque')->store('destaque', 'public');
                                        $post->destaque = $imagePath;
                              }

                              $post->jogadores = $validatedData['jogadores'];
                              $post->descricao = $validatedData['descricao'];
                              $post->save();

                              return redirect()->route('destaque-index')->with('success', 'Atualizado com sucesso o post');
                    } catch (Exception $e) {
                              Log::error('Erro ao atualizar post: ' . $e->getMessage());
                              return back()->withInput()->with('error', 'Erro ao atualizar post.');
                    }
          }

          /**
           * Remove the specified resource from storage.
           */
          public function destroy(string $id)
          {
                    try {
                              $post = DestaqueModel::find($id);
                              if (!$post) {
                                        return redirect()->route('destaque-index')->with('error', 'Post não encontrado');
                              }

                              // Verificar se há um arquivo associado ao post e excluí-lo
                              if ($post->destaque) {
                                        Storage::delete($post->destaque);
                              }

                              $post->delete();

                              return redirect()->route('destaque-index')->with('success', 'Post excluído com sucesso!');
                    } catch (Exception $e) {
                              Log::error('Erro ao excluir post: ' . $e->getMessage());
                              return back()->withInput()->with('error', 'Erro ao excluir post.');
                    }
          }
}
