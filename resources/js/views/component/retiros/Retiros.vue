<template>
<div >
<menu-item></menu-item>
<br>
<div class="container">
<div class="table-container">
  <div class="buttons">
    <router-link to="/retiros/register" class="button is-success">
      registrar
    </router-link>    
  </div>
  <table class="table">
  <thead>
      <tr>
        <th>codigo</th>
        <th>usuario</th>
        <th>cliente</th>

        <th>valor retiro</th>
        <th>descripcione</th>
        <th>acciones</th>
      </tr>
    </thead>
    <tbody>
      <tr>
          <tr v-for="retiro in retiros" :key="retiro.id">
                    <td>{{retiro.codigo_retiro}}</td>
                    <td>{{retiro.nombre_usuario}}</td>
                    <td>{{retiro.descripcion_cuenta}}</td>
                    <td>{{retiro.valor_retiro}}</td>
                    <td>{{retiro.descripcion}}</td>
                   
                    <td>  
                     <div class="buttons">
                        <router-link :to="{ name: 'updateRetiros', params: { id: retiro.id } }"  class="button is-primary">
                          editar
                        </router-link>                        
                        <a @click="deleteRetiros(retiro.id)" class="button is-danger">
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
      retiros:[],
    };
  },
 created() {
     this.$store
        .dispatch("listRetiros", {

        }).then((res) => {
    
          this.retiros = res.data.data.retiros;
       
      }).catch((error) => {
        console.log(error);
      });    
  },

  components: {
       "menu-item": menu_iems_pages
  },

  methods: {

    
    deleteRetiros(id){

      let indexOfArrayItem = this.retiros.findIndex((i) => i.id === id);

       if (window.confirm("Estas seguro de eliminar este retiros?")) {
        this.$store
        .dispatch("deleteRetiros", {

          id: id,
      
        })
        .then(response => {
            this.retiros.splice(indexOfArrayItem, 1);

        })
        .catch(error => {
         console.log( error);
        });
      }

    }

   
  },

};
</script>