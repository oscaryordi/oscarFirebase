<?php
include('1header.php');
include('2nav.php');
?>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
<h1>Placas</h1>   






<!-- contenido -->

<h1>Placas de Circulación</h1>
  <h2>Placas</h2>
  <h3>Create / Update</h3>
  <form id="vehiculos-form">
    <input type="text" id="serie" placeholder="Serie" required>
    <br>
    <input type="text" id="placas" placeholder="Placas" required>
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

<!-- contenido -->



</main>
<?php
include('3footer.php');