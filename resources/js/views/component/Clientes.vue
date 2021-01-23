<template>
<div>
  <nav class="navbar" role="navigation" aria-label="main navigation">
  <div class="navbar-brand">
    <a class="navbar-item" href="https://bulma.io">
      <img src="https://bulma.io/images/bulma-logo.png" width="112" height="28">
    </a>

    <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
    </a>
  </div>

  <div id="navbarBasicExample" class="navbar-menu">
    <div class="navbar-start">
      <a class="navbar-item">
        clientes
      </a>

      <a class="navbar-item">
        Documentation
      </a>

      <div class="navbar-item has-dropdown is-hoverable">
        <a class="navbar-link">
          More
        </a>

        <div class="navbar-dropdown">
          <a class="navbar-item">
            About
          </a>
          <a class="navbar-item">
            Jobs
          </a>
          <a class="navbar-item">
            Contact
          </a>
          <hr class="navbar-divider">
          <a class="navbar-item">
            Report an issue
          </a>
        </div>
      </div>
    </div>

    <div class="navbar-end">
      <div class="navbar-item">
        <div class="buttons">
          <a class="button is-primary">
            <strong>Sign up</strong>
          </a>
          <a class="button is-light">
            Log in
          </a>
        </div>
      </div>
    </div>
  </div>
</nav>
<div class="table-container">
  <table class="table">
  <thead>
      <tr>
        <th>Tpo de documento</th>
        <th>numero de cedula</th>
        <th>apellido</th>
        <th>nombre</th>
        <th>direccion</th>
        <th>telefono</th>
        <th>correo</th>
        <th>acciones</th>
      </tr>
    </thead>
    <tbody>
      <tr>
          <tr v-for="cliente in clientes" :key="cliente.id">
                    <td>{{cliente.nombre_doc}}</td>
                    <td>{{cliente.numero_cedula}}</td>
                    <td>{{cliente.apellidos}}</td>
                    <td>{{cliente.nombres}}</td>
                    <td>{{cliente.direccion}}</td>
                    <td>{{cliente.telefono}}</td>
                    <td>{{cliente.email}}</td>
                    <td>  
                     <div class="buttons">
                        <a class="button is-primary">
                          <strong>editar</strong>
                        </a>
                        <a class="button is-danger">
                          eliminar
                        </a>
                    </div> 
                  </td>

          
      </tr>
     
    </tbody> 
    </table>
</div>
</div>
</template>

<script>
export default {
   data() {
    return {
      clientes:[],
    };
  },
 created() {
     this.$store
        .dispatch("listCliente", {

        }).then((res) => {
    
          this.clientes = res.data.data.clientes;
       
      }).catch((error) => {
        console.log(error);
      });    
  },
  methods: {



   
  },

};
</script>