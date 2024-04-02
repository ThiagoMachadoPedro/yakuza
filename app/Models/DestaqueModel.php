<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DestaqueModel extends Model
{
    use HasFactory;

          protected $table = 'destaques';


          protected $fillable = [
                    'jogadores',
                    'destaque',
                    'descricao',
                    'id_user',
          ];


          // colocar o mesmo nome quem vem do banco de dados
          public function user()
          {
                    return $this->belongsTo(User::class, 'id_user');
          }
}
