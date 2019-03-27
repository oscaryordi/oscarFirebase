
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>Infracciones</title>

    <!-- Bootstrap core CSS -->
<link href="/docs/4.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="starter-template.css" rel="stylesheet">
    <link href="css/oscarFirebase.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  </head>
  <body>
    <nav class="navbar navbar-expand-md navbar-light bg-light fixed-top ">

  <a class="navbar-brand" href="#">
      Infracciones 
    <i class="fas fa-car-crash"></i>
  </a>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarsExampleDefault">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Inicio <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Infracciones</a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#">Usuarios</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Status</a>
        <div class="dropdown-menu" aria-labelledby="dropdown01">
          <a class="dropdown-item" href="#">Todas</a>
          <a class="dropdown-item" href="#">Pagadas</a>
          <a class="dropdown-item" href="#">Pendientes</a>
        </div>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="text" placeholder="Buscar" aria-label="Search">
      <button class="btn btn-secondary my-2 my-sm-0" type="submit">Buscar</button>
    </form>
  </div>
</nav>

<main role="main" class="container">

  <div class="starter-template py-0 my-0">
    <h1>Infracciones</h1>
    <p>Seguimiento a infracciones.</p>
  </div>
  <h1>CRUD con Firebase</h1>
  <h2>Unidades Vehiculares</h2>
  <h3>Create / Update</h3>
  <form id="vehiculos-form">
    <input type="text" id="marca" placeholder="Marca" required>
    <br>
    <input type="text" id="submarca" placeholder="Submarca" required>
    <br>
    <input type="text" id="tipo" placeholder="Tipo" required>
    <br>
    <input type="text" id="modelo" placeholder="Modelo" required>
    <br>
    <input type="text" id="color" placeholder="Color" required>
    <br>
    <input type="text" id="motor" placeholder="Motor" required>
    <br>
    <input type="hidden" id="id">
    <input type="submit" value="Salvar">
  </form>
  <h3>Read / Delete</h3>
  <ul id="vehiculos"></ul>
  <script src="https://www.gstatic.com/firebasejs/5.8.2/firebase.js"></script>
  <script>
    // Initialize Firebase
    const config = {
      apiKey: "AIzaSyDjurFnuupuRhdcIm3mdp0XFpJwRh7W3C4",
      authDomain: "oscar-319c4.firebaseapp.com",
      databaseURL: "https://oscar-319c4.firebaseio.com",
      projectId: "oscar-319c4",
      storageBucket: "oscar-319c4.appspot.com",
      messagingSenderId: "559602151820"
    };



    firebase.initializeApp(config);
    const db = firebase.database(),
      vehiculosRef = db.ref().child('vehiculos'),
      vehiculosForm = document.getElementById('vehiculos-form'),
      vehiculosMarca = document.getElementById('marca'),
      vehiculosSubmarca = document.getElementById('submarca'),
      vehiculosTipo = document.getElementById('tipo'),
      vehiculosModelo = document.getElementById('modelo'),
      vehiculosColor = document.getElementById('color'),
      vehiculosMotor = document.getElementById('motor'),
      vehiculosId = document.getElementById('id'),
      vehiculo = document.getElementById('vehiculos')
    //CREATE


    vehiculosForm.addEventListener('submit', e => {
      e.preventDefault()
      let id = vehiculosId.value || vehiculosRef.push().key,
        data = {
          marca: vehiculosMarca.value,
          submarca: vehiculosSubmarca.value,
          tipo: vehiculosTipo.value,
          modelo: vehiculosModelo.value,
          color: vehiculosColor.value,
          motor: vehiculosMotor.value
        },
        updateData = {}
      updateData[`/${id}`] = data
      vehiculosRef.update(updateData)
      vehiculosId.value = ''
      vehiculosForm.reset()
    })


    //READ
    function vehiculosTemplate({ marca, submarca, tipo, modelo, color, motor }) {
      return `
        <span class="marca">${marca}</span>
        -
        <span class="submarca">${submarca}</span>
        -
        <span class="tipo">${tipo}</span>
        -
        <span class="modelo">${modelo}</span>
        -
        <span class="color">${color}</span>
        -
        <span class="motor">${motor}</span>
        -
        <button class="edit">Editar</button>
        <button class="delete">Eliminar</button>
      `
    }
    vehiculosRef.on('child_added', data => {
      let li = document.createElement('li')
      li.id = data.key
      li.innerHTML = vehiculosTemplate(data.val())
      vehiculos.appendChild(li)
    })
    vehiculosRef.on('child_changed', data => {
      let affectedNode = document.getElementById(data.key)
      affectedNode.innerHTML = vehiculosTemplate(data.val())
    })
    vehiculosRef.on('child_removed', data => {
      let affectedNode = document.getElementById(data.key)
      affectedNode.parentElement.removeChild(affectedNode)
    })


    document.addEventListener('click', e => {
      let affectedNode = e.target.parentElement
      //console.log(affectedNode)
      //UPDATE
      if (e.target.classList.contains('edit')) {
        vehiculosMarca.value = affectedNode.querySelector('.marca').innerText
        vehiculosSubmarca.value = affectedNode.querySelector('.submarca').innerText
        vehiculosTipo.value = affectedNode.querySelector('.tipo').innerText
        vehiculosModelo.value = affectedNode.querySelector('.modelo').innerText
        vehiculosColor.value = affectedNode.querySelector('.color').innerText
        vehiculosMotor.value = affectedNode.querySelector('.motor').innerText
        vehiculosId.value = affectedNode.id
      }
      //DELETE
      if (e.target.classList.contains('delete')) {
        let id = affectedNode.id
        db.ref().child(`vehiculos/${id}`).remove()
      }
    })

  </script>

















</main><!-- /.container -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="/docs/4.2/assets/js/vendor/jquery-slim.min.js"><\/script>')</script><script src="/docs/4.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-zDnhMsjVZfS3hiP7oCBRmfjkQC4fzxVxFhBx8Hkz2aZX8gEvA/jsP3eXRCvzTofP" crossorigin="anonymous"></script></body>
</html>