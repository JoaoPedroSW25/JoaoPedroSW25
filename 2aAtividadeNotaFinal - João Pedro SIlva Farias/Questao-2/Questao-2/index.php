<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=10">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" >
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>Gerenciamento de Tarefas</title>
    <style>
      @import url('https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@0,100..900;1,100..900&display=swap');

      * {
        font-family: noto, serif;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }
      body {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
        background-image: url("https://i.pinimg.com/736x/b8/9d/59/b89d59a4ddde3d6ce01185904089db4b.jpg");
        background-size: cover;
        background-repeat: no-repeat;
      }
      #app {
        display: flex;
        flex-direction: column;
        gap: 25px;
        background-color: rgb(72, 17, 121);
        padding: 25px;
        border-radius: 10px;
        width: 350px;
      }
      #app h1{
        font-size: 20px;
        color: rgb(131, 37, 192);
        text-transform: uppercase;
      }
      .form-app{
        display: flex;
        width: 100%;
      }
      .form-app input{
        background-color: transparent;
        border: none;
        color: rgb(199, 24, 50);
        font-size: 16px;
        width: 100%;
        padding: 4px;
        border-bottom: 2px solid rgb();
      }
      .form-app input:focus-visible {
        outline: none;
      }
      .form-app .bnt-app {
        border: none;
        min-height: 40px;
        min-width: 40px;
        background-color: rgb(106, 77, 86);
        border-radius: 50px;
        font-size: 20px;
        transition: scale 0.5s ease;
        color: rgb(179, 10, 128 )
      }
      .form-app .bnt-app:hover{
        cursor: pointer;
        scale: 1.05;
      }
      #tarefas {
        display: flex;
        flex-direction: column;
        gap: 10px;
        max-height: 400px;
        overflow: auto;
      }
      .tarefa {
        display: flex;
        align-items: center;
        justify-content: space-between;
        color: rgb(195, 35, 112);
        background-color: rgb(0, 0, 0);
        padding: 10px 12px;
        border-radius: 4px;
      }
      .tarefa .progresso{
        margin-right: 10px;
      }
      .tarefa.progresso.done + .descrição{
        text-decoration:line-through;
        color: white;
      }
      .tarefa .descrição {
        font-size: 16px;
        color: rgb(109, 150, 160);
        padding: 4px 0px;
        width: 100%;
      }
      .tarefa .ações-tarefas{
        display: flex;
        gap: 10px;
      }
      .action-button{
        font-size: 18px;
      }
      .action-button.edit-button{
        color: rgb(0, 255, 0);
      }
      .action-button.delete-button{
        color: rgb(255, 0, 0);
      }
      .hidden{
        display: none !important;
      }
      @media screen and (max-width: 600px) {
        #app{
          width: 300px;
        }
      }
    </style>
  </head>
  <body>
    <div id="app">
      <h1>MY LIST</h1>

      <form action="update.php?action=read" method="POST" class="form-app">
        <input type="text" name="description" placeholder="Escreva sua tarefa aqui!" required>
        <button type="submit" class="btn-app"> <i class="fa-solid fa-plus"></i> </button>
      </form>
        <div id="tarefas">
          <div class="tarefa">
            <input type="checkbox" name="progresso" class="progresso">

            <p class="descrição">
              tarefa
            </p>
            <div class="ações-tarefas">
              <a class="action-button edit-button">
                <i class="fa-regular fa-pen-to-square"></i>
              </a>
              <a href="" class="action-button delete-button">
                <i class="fa-regular fa-trash-can"></i>
              </a>
            </div>
            <form action="update.php?action=edit" class="form-app edit-tarefas hidden">
              <input type="text" name="description" placeholder="Atualizar a sua tarefa!">
              <button type="submit" class="btn-app"> <i class="fa-solid fa-check"></i> </button>
            </form>
          </div>
        </div>
    </div>

    <script>
      $(document).ready(function(){
        $('.edit-button').on('click', function(){
         var $tarefa = $(this).closest('.tarefa');
          $tarefa.find('.progresso').addClass('hidden');
          $tarefa.find('.descrição').addClass('hidden');
          $tarefa.find('.ações-tarefas').addClass('hidden');
          $tarefa.find('.edit-tarefas ').removeClass('hidden');
        });
        $('.progresso').on('click', function (){
          if ($(this).is(':checked')){
            $(this).addClass('done');
          }else {
            $(this).removeClass('done');
          }
        })
      });
    </script>
  </body>
</html>