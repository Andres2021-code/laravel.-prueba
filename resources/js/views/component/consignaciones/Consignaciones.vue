<template>
<div >
<menu-item></menu-item>
<br>
<div class="container">
<div class="table-container">
  <div class="buttons">
    <router-link to="/cliente/register" class="button is-success">
      registrar
    </router-link>    
  </div>
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
                        <router-link :to="{ name: 'updatecliente', params: { id: cliente.id } }"  class="button is-primary">
                          editar
                        </router-link>                        
                        <a @click="deleteCliente(cliente.id)" class="button is-danger">
                          eliminar
                        </a>
                    </div> 
                  </td>

          
      </tr>

    </tbody> 
    </table>
      </div>
    </div>
  </div>
</template>

<script>
import menu_iems_pages from "../helper/menu"
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

  components: {
       "menu-item": menu_iems_pages
  },

  methods: {

    
    deleteCliente(id){

      let indexOfArrayItem = this.clientes.findIndex((i) => i.id === id);

       if (window.confirm("Estas seguro de eliminar este cliente?")) {
        this.$store
        .dispatch("deleteCliente", {

          id: id,
      
        })
        .then(response => {
            this.clientes.splice(indexOfArrayItem, 1);

        })
        .catch(error => {
         console.log( error);
        });
      }

    }

   
  },

};
</script>