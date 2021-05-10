<?php require_once('header.php'); ?>
<div class="container my-5">
  <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">№п/п</th>
        <th scope="col">Название</th>
        <th scope="col">Автор</th>
        <th scope="col">Дата добавления</th>
        <th scope="col">Управление</th>
      </tr>
    </thead>
    <tbody id="tbody">
      
    </tbody>
  </table>
</div>
<script>
  const tbody = document.getElementById("tbody");
  show();
  function show(){
    fetch('/php/getPosts.php')
      .then(response=>response.json())
      .then(result=>{
        for(let i=0; i<result.length; i++){
          tbody.innerHTML += `
              <tr>
                <th scope="row">${i+1}</th>
                <td><a href="/getArticle.php?id=${result[i].id}">${result[i].title}</a></td>
                <td>${result[i].author}</td>
                <td>${result[i].add_date}</td>
                <td><a href="/updatePost.php?id=${result[i].id}" class="btn btn-primary">редактировать</a><br>
                    <button id="btn-danger" onclick="deletePost(${result[i].id});return false;" class="btn btn-danger">удалить</button>
                </td>
              </tr>`;
        }
      });
   }
  //const button = document.getElementById("btn-danger");
    //const button = .querySelector(".btn-danger");
     //console.log(button+"jjkkk");
    function deletePost(id){
      console.log("uuuu"+id);
      const formData = new FormData();
      formData.append('id',id);
      console.log(formData);
      fetch("php/handlerDeletePost.php",{
        method: "POST",
        body: formData
      }).then(response=>response.text())
        .then(result=>{
          if(result==='success'){
            //ocation.href='/';
            tbody.innerHTML ="";
            show();
          }
        });
      //tbody.innerHTML ="";
      //show();
    }
</script>

<?php require_once('footer.php'); ?>