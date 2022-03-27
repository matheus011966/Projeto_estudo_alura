<?php

class Artigo {

    private $mysql;

    public function __construct(mysqli $mysql)
    {
        $this -> mysql = $mysql;
        
    }

    public function adicionar(string $titulo, string $conteudo): void
    {
    
        $InsereArtigo = $this -> mysql-> prepare('INSERT INTO artigos (titulo, conteudo) VALUES (?,?);');
        $InsereArtigo -> bind_param('ss', $titulo, $conteudo);
        $InsereArtigo-> execute();
    

    }

    public function exibirTodos(): array
    {
        $resultado = $this -> mysql -> query('SELECT id, titulo, conteudo FROM artigos');
        $artigos = $resultado -> fetch_all(MYSQLI_ASSOC);
        
        return $artigos;
    }

    public function encontrarPorId(string $id): array
    {
        $SelecionaArtigo = $this -> mysql -> prepare("SELECT id, titulo, conteudo FROM artigos 
        WHERE id = ?");
        $SelecionaArtigo -> bind_param('s', $id);
        $SelecionaArtigo -> execute(); 
        $artigo = $SelecionaArtigo -> get_result()-> fetch_assoc();
        return $artigo;
     }
}

?>