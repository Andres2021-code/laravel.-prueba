<template>
<div >
<menu-item></menu-item>
<br>
<div class="container">
<div class="table-container">
  <div class="buttons">
    <router-link to="/cuenta/register" class="button is-success">
      registrar
    </router-link>    
  </div>
  <table class="table">
  <thead>
      <tr>
        <th>Numero de cuenta</th>
        <th>Cliete</th>
        <th>saldo</th>
        <th>Activa</th>
        <th>Clave cuenta</th>
        <th>Direccion</th>
        <th>Acciones</th>

      </tr>
    </thead>
    <tbody>
      <tr>
          <tr v-for="cuenta in cuentas" :key="cuenta.id">
                    <td>{{cuenta.numero_cuenta}}</td>
                    <td>{{cuenta.nombres}}</td>
                    <td>{{cuenta.saldo}}</td>
                    <td>{{cuenta.activa}}</td>
                    <td>{{cuenta.clave_cuenta}}</td>
                    <td>{{cuenta.descripcion}}</td>
                    <td>  
                     <div class="buttons">
                        <router-link :to="{ name: 'updateCuenta', params: { id: cuenta.id } }"  class="button is-primary">
                          editar
                        </router-link>                        
                        <a @click="deleteCuenta(cuenta.id)" class="button is-danger">
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
      cuentas:[],
    };
  },
 created() {

     this.$store
        .dispatch("listCuenta", {

        }).then((res) => {
          console.log(res.data.data.cuentas)
          this.cuentas = res.data.data.cuentas;
       
      }).catch((error) => {
        console.log(error);
      });    
  },


  components: {
       "menu-item": menu_iems_pages
  },

  methods: {

    
    deleteCuenta(id){

      let indexOfArrayItem = this.cuentas.findIndex((i) => i.id === id);

       if (window.confirm("Estas seguro de eliminar este cuenta?")) {
        this.$store
        .dispatch("deleteCuenta", {

          id: id,
      
        })
        .then(response => {
            this.cuentas.splice(indexOfArrayItem, 1);

        })
        .catch(error => {
         console.log( error);
        });
      }

    }

   
  },

};
</script>