<?php



$db = new PDO('sqlite:./database.db');
$sql = 'CREATE TABLE IF NOT EXISTS tarefas (id INTEGER PRIMARY KEY, description VARCHAR(50) NOT NULL, 
COMPLETED BOOLEAN DEFAULT FALSE)';

$db->exec($sql);


$action = $_GET['action'];

if ($action == 'read') {
    $stmt = $db->query('SELECT * FROM tarefas ORDER BY id DESC');
    $tarefas = $stmt->fetchAll(PDO::FETCH_ASSOC);
  header('content-type: application/json');
  echo json_encode($tarefas);
  exit;
}

if ($action =='create' && isset($_POST['description'])){
  $desc = $_POST['description'];
  $stmt = $db->prepare('INSERT INTO tarefas (description) Values (:desc)');
  $stmt->bindParam(':desc', $desc);
  $stmt->execute();
  header('location: ./index.php');
  exit;
}

if ($action == 'edit' && isset($_POST['id']) && isset($_POST['description'])){
  $stmt = $db->prepare('UPDATE tarefas SET description = :desc WHERE id = :id');
  $stmt->execute([
  ':desc' => $_POST['description'],
  'i:d' => $_POST['id']              
]);
header('location: ./index.php');
exit;
}

if ($action == 'delete' && isset($_GET['id'])){
  $stmt = $db->prepare('DELETE FROM tarefas WHERE id = :id');
  $stmt->execute([':id' => $_GET['id']]);
  header('location: ./index.php');
  exit;
}


?>
