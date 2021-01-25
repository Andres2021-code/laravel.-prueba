<template>
<div >
<menu-item></menu-item>
<br>
<div class="container">
<div class="table-container">
  <div class="buttons">
    <router-link to="/consignaciones/register" class="button is-success">
      registrar
    </router-link>    
  </div>
  <table class="table">
  <thead>
      <tr>
        <th>codigo</th>
        <th>usuario</th>
        <th>cliente</th>
  
        <th>valor consignacion</th>
        <th>descripcione</th>
        <th>acciones</th>
      </tr>
    </thead>
    <tbody>
      <tr>
          <tr v-for="consignacion in consignaciones" :key="consignacion.id">
                    <td>{{consignacion.codigo_consignaciones}}</td>
                    <td>{{consignacion.nombre_usuario}}</td>
                    <td>{{consignacion.descripcion}}</td>
                    <td>{{consignacion.valor_consignacion}}</td>
                    <td>{{consignacion.descripcion_consignacion}}</td>
                   
                    <td>  
                     <div class="buttons">
                        <router-link :to="{ name: 'updateConsignaciones', params: { id: consignacion.id } }"  class="button is-primary">
                          editar
                        </router-link>                        
                        <a @click="deleteConsignaciones(consignacion.id)" class="button is-danger">
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
      consignaciones:[],
    };
  },
 created() {
     this.$store
        .dispatch("listConsignaciones", {

        }).then((res) => {
    
          this.consignaciones = res.data.data.consignaciones;
       
      }).catch((error) => {
        console.log(error);
      });    
  },

  components: {
       "menu-item": menu_iems_pages
  },

  methods: {

    
    deleteConsignaciones(id){

      let indexOfArrayItem = this.consignaciones.findIndex((i) => i.id === id);

       if (window.confirm("Estas seguro de eliminar este consignaciones?")) {
        this.$store
        .dispatch("deleteConsignaciones", {

          id: id,
      
        })
        .then(response => {
            this.consignaciones.splice(indexOfArrayItem, 1);

        })
        .catch(error => {
         console.log( error);
        });
      }

    }

   
  },

};
</script>