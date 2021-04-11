<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Episodio extends Model
{
    public $timestamps = false;
    protected $fillable = ['temporada', 'numero', 'assistido', 'serie_id'];
    protected $perPage = 3;
    protected $appends = ['links'];

    public function serie()
    {
        return $this->belongsTo(Serie::class);
    }

    public function getAssistidoAtributo($assistido): bool
    {
        return $assistido;
    }

    public function setNomeAttribute($nome)
    {
        $this->attributes['nome'] = strtoupper($nome);
    }

    public function getLinksAttribute(): array
    {
        return [
            'serie' => '/api/series/' . $this->serie_id
        ];
    }
}
