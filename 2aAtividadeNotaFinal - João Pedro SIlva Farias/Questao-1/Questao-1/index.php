<?php
session_start();
$mensagem = '';
if (isset($_SESSION['mensagem'])) {
    $mensagem = $_SESSION['mensagem'];
    unset($_SESSION['mensagem']);

}  
$db = new PDO('sqlite:database.db');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$db->exec("CREATE TABLE IF NOT EXISTS books(id INTEGER PRIMARY KEY, titulo TEXT, autor TEXT, ano_publicação TEXT)");

$result = $db->query('SELECT * FROM books');
  
?>
<!DOCTYPE HTML>
<html>
  <head>
    <meta charset="utf-8" >
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="João Pedro Silva Farias">
    <title>Banco de Dados da Livraria - Questão 1</title>
    <style>
      body {
        font-size: 18px;
        background-image: url('https://apaixonadosporhistoria.com.br/img/artigocapa/artigocapa_20191002102818_1573221015.jpg');
        background-repeat: no-repeat;
        background-size: cover;
      }
      h1 {
        font-size: 35px;
        text-align: center;
        font-style: italic;
        color: rgb(176, 133, 133);
      }
      h2 {
        font-size: 35px;
        text-align: center;
        font-style: italic;
        color: rgb(176, 133, 133);
      }
      table {
        margin-left: auto;
        margin-right: auto;
        border: 2px solid black;
      }
      th {
        color: rgb(176, 133, 133);
        font-size: 20px;
        font-style: italic;
      }
      td{
        color: rgb(161, 21, 21);
        font-size: 15px;
        font-family: cursive;
        text-align: center;
      }
      input {
        font-size: 15px;
        background-color: rgb(0, 0, 0);
        color: rgb(161, 21, 21);
      }
      input:hover {
        border-color: rgb(161, 21, 21);
      }
      .formulario {
        width: 250px;
        border: 2px solid black;
        padding: 20px;
        margin: 10px;
        box-shadow: 4px 4px 8px rgb(0, 0, 0);
        border-radius: 70px
      }
      input[type="submit"] {
        color: rgb(161, 21, 21);
      }
      input[type="submit"]:hover {
        cursor: pointer;
        transform: scale(1.1);
        
      }
      a {
        color: rgb(161, 21, 21);
        font-size: 18px;
        text-decoration: none;
        font-style: italic;
        cursor: pointer;
      }
    </style>
    </head>
  <body>
      <h1> livraria Constatine </h1>
      <div>
          <h2>Catálago de Livros</h2>  
    <?php if (!empty($mensagem)) : ?>
    <p style="color: rgb(14, 38, 174); font-family: italic; font-size: 20px;"><?php  echo $mensagem; ?></p>
    <?php endif; ?>
          <table border = "2">
           <thead>
            <tr>
              <th>ID</th>
              <th>Titulo</th>
              <th>Autor</th>
              <th>Ano de Publicação</th>
              <th>Ação</th>
            </tr>
           </thead>
           <tbody>
             <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)) : ?>
            <tr>
              <td><?php echo $row['id']; ?></td>
              <td><?php echo $row['titulo']; ?></td>
              <td><?php echo $row['autor']; ?></td>
              <td><?php echo $row['ano_publicação'];?></td>
              <td><a href="add_book.php?add_book=delete&id=<?php echo $row['id']; ?>" onclick="return confirm('tem certeza que deseja excluir esse livro?')">Excluir</td>
            </tr>
          <?php endwhile; ?>
           </tbody>
          </table>
       <div class="formulario">
           <h2> Cadastro de Livros: </h2>
           <form action="add_book.php?add_book=insert" method="POST">
             <input type="hidden" name="id">
             <label for="titulo"> Titulo: </label><br>
             <input type="text" id="titulo" name="titulo" required><br>
             <label for="autor"> Autor: </label><br>
             <input type="text" id="autor" name="autor" required><br>
             <label for="ano_publicação"> Ano de Publicação: </label><br>
             <input type="date" id="ano" name="ano_publicação" required><br><br>

             <input type="submit" value="Cadastrar"><br><br>
           </form>
       </div>
    
  </body>
</html>