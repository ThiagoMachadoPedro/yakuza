<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PostModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class PostController extends Controller
{
          /**
           * Display a listing of the resource.
           */
          public function index(Request $request)
          {
                    // pesquisa qual nivel de acesso para passar pra view
                    $access_level = Auth::check() ? Auth::user()->access_level : null;


                    $query = PostModel::with('user')->orderBy("created_at", "desc");

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

                    return view("post.index", ["posts" => $posts, "access_level" => $access_level]);
          }





          /**
           * Show the form for creating a new resource.
           */
          public function create()
          {
                    return view("post.create");
          }

          /**
           * Store a newly created resource in storage.
           */
          public function store(Request $request)
          {
                    try {
                              $validatedData = $request->validate([
                                        'jogadores' => 'required|string|max:255',
                                        'imagem' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                                        'descricao' => 'required|string|max:255',
                                        // Adicione outras regras de validação conforme necessário
                              ]);

                              $user = Auth::user(); // Obter o usuário autenticado

                              $post = new PostModel();
                              $post->jogadores = $validatedData['jogadores'];

                              // Processar o upload da imagem, se existir
                              if ($request->hasFile('imagem')) {
                                        $imagePath = $request->file('imagem')->store('post', 'public');
                                        $post->imagem = $imagePath;
                              }

                              $post->descricao = $validatedData['descricao'];
                              $post->id_user = $user->id; // Associar o post ao usuário autenticado
                              $post->save();

                              return redirect()->route('post-index')->with('success', 'Post criado com sucesso!');
                    } catch (Exception $e) {
                              Log::error('Erro ao criar post: ' . $e->getMessage());
                              return back()->withInput()->with('error', 'Erro ao criar post.');
                    }
          }


          /**
           * Display the specified resource.
           */
          public function show(string $id)
          {
                    $post = PostModel::findOrFail($id);
                    return view("post.visualizar", ["post" => $post]);
          }





          /**
           * Show the form for editing the specified resource.
           */
          public function edit(string $id)
          {
                    $post = PostModel::find($id);

                    if (!$post) {
                              return redirect()->route('post-index')->with('error', 'Post não encontrado.');
                    }

                    return view('post.edit', compact('post'));
          }

          /**
           * Update the specified resource in storage.
           */
          public function update(Request $request, string $id)
          {
                    try {
                              $post = PostModel::find($id);

                              if (!$post) {
                                        return redirect()->route('post-index')->with('error', 'Post não encontrado.');
                              }

                              $validatedData = $request->validate([
                                        'jogadores' => 'required|string|max:255',
                                        'descricao' => 'required|string|max:255',
                                        'imagem' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                              ]);

                              if ($request->hasFile('imagem')) {
                                        $imagePath = $request->file('imagem')->store('post', 'public');
                                        $post->imagem = $imagePath;
                              }

                              $post->jogadores = $validatedData['jogadores'];
                              $post->descricao = $validatedData['descricao'];
                              $post->save();

                              return redirect()->route('post-index')->with('success', 'Atualizado com sucesso o post');
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
                              $post = PostModel::find($id);
                              if (!$post) {
                                        return redirect()->route('post-index')->with('error', 'Post não encontrado');
                              }

                              // Verificar se há um arquivo associado ao post e excluí-lo
                              if ($post->imagem) {
                                        Storage::delete($post->imagem);
                              }

                              $post->delete();

                              return redirect()->route('post-index')->with('success', 'Post excluído com sucesso!');
                    } catch (Exception $e) {
                              Log::error('Erro ao excluir post: ' . $e->getMessage());
                              return back()->withInput()->with('error', 'Erro ao excluir post.');
                    }
          }
}
