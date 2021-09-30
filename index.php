<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Ejemplo con vue">
  <title>Ejemplo con Vue</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css">
</head>

<body class="bg-dark" style="--bs-bg-opacity: .97;">

  <!-- header -->
  <?php include_once './components/header.php'; ?>

  <div id="templateVue" class="container py-4">

    <div v-if="message" :class="classAlert" role="alert">
      {{ message }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <div class="row">
      <div class="col-md-5">

        <div class="card bg-dark text-white rounded-3">
          <div class="card-body">
            <h5 class="card-title text-center h3">Nuevo salon</h5>
            <form @submit.prevent="selecionAction">
              <div class="mb-3">
                <label for="regAula" class="form-label">Aula</label>
                <input v-model="aula" type="number" class="form-control text-white bg-dark" id="regAula" aria-describedby="emailHelp">
              </div>
              <div class="mb-3">
                <label for="regSession" class="form-label">Seccion</label>
                <input v-model="seccion" type="text" class="form-control text-white bg-dark" id="regSession" aria-describedby="emailHelp">
              </div>
              <button type="submit" :class="idClass">Submit</button>
            </form>
          </div>
        </div>
        <!-- end card -->
      </div>
      <div class="col-md-7">
        <input type="text" v-model="searchInput" class='form-control bg-dark text-white' placeholder="search...">

        <table class="table text-center table-dark text-white table-striped">
          <thead>
            <tr>
              <th v-for="title in titleHeaderTable" :key='title'>{{ title }}</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(aula,index) in filterAulas">
              <td>{{ index + 1 }}</td>
              <td>{{ aula.aula }}</td>
              <td>{{ aula.seccion }}</td>
              <td>
                <button @click="rellenarForm(aula)" class="btn btn-sm btn-warning">Edit</button>
                <button @click="deleteAula(aula.id)" class="btn btn-sm btn-danger">Close</button>
              </td>
            </tr>
          </tbody>
        </table>
        <!-- end table -->
      </div>
    </div>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script src="./public/js/vueScript.js"></script>
</body>

</html>