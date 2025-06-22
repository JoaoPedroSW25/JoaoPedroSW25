<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

try { 

$db = new PDO('sqlite:database.db');
$pdo = __DIR__ . '/database.db';

$action = isset($_GET['add_book']) ? $_GET['add_book'] : '';

if($action == 'insert') { 
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $ano_publicação = $_POST['ano_publicação'];

    $stmt = $db->prepare("INSERT INTO books (titulo, autor, ano_publicação) VALUES (:titulo, :autor, :ano_publicação)");
    $stmt->bindParam(':titulo', $titulo);
    $stmt->bindParam(':autor', $autor);
    $stmt->bindParam(':ano_publicação', $ano_publicação);

    $stmt->execute();

    header('Location: index.php');
    exit();
}
if ($action == 'delete') {
    $id = $_GET['id'];
    $stmt = $db->prepare('DELETE FROM books WHERE id = :id');
    $stmt->bindParam(':id', $id);
    if ($stmt->execute()) {
     $_SESSION['mensagem'] = 'livro excluido com sucesso!';
    } else {
     $_SESSION['mensagem'] = 'Error ao excluir!';
    }
    header('Location: index.php');
    exit();
  }  
}catch (PDOException $e) {
    echo 'Erro:' . $e->getMessage();
}

?>