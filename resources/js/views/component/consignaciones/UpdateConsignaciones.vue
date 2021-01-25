<template>
  <div>
    <menu-item></menu-item>

    <div class="container">
      <div class="column is-4 is-offset-4">
        <div class="box">
          <h1 class="title">Actualizar consignacion</h1>
          <div class="notification is-danger" v-if="error">
            <p>{{error}}</p>
          </div>
          <form autocomplete="off" @submit.prevent="register" method="post">

             <input type="hidden" class="input" placeholder="nombre" v-model="consignacion.id" />

           <div class="field">
              <div class="control">
                <input type="text" class="input" placeholder="codigo" v-model="consignacion.codigo_consignaciones" />
              </div>
            </div>

                <div class="field">
             
                <div class="select">
                  <select @change="onChangeCuenta($event)" :value="consignacion.id_cuenta">                  
                    <option>selecciona un cuenta</option>
                    <option v-for="cuenta in cuentas" v-bind:key="cuenta.id" v-bind:value="cuenta.id"> {{ cuenta.descripcion }} </option>
                  </select>
                </div>         
             
            </div>

              <div class="field">
             
            <div class="select">
                  <select @change="onChangeUsuario($event)" :value="consignacion.id_usuario">                  
                    <option>selecciona un usuario</option>
                    <option v-for="user in users" v-bind:key="user.id" v-bind:value="user.id"> {{ user.nombre_usuario }} </option>
                  </select>
                </div>  
             
            </div>

          
             <div class="field">
              <div class="control">
                <input type="number" class="input" placeholder="valor consignacion" v-model="consignacion.valor_consignacion" />
              </div>
            </div>

             <div class="field">
              <div class="control">
                <input type="text" class="input" placeholder="descripcion" v-model="consignacion.descripcion_consignacion" />
              </div>
            </div> 

            <button type="submit" class="button is-primary">Actualizar</button>
          </form>
        </div>
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
      users: [],
      id_cuenta: null,
      id_usuario:null,
      consignacion: [],
      error: null
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
        this.$store
        .dispatch("listConsignacionesUser", {

        }).then((res) => {
          console.log(res.data.data.users)
          this.users = res.data.data.users;
       
      }).catch((error) => {
        console.log(error);
      });    
       this.$store
        .dispatch("listOneConsignaciones", {

          id: this.$route.params.id,
      
        })
        .then(response => {
          this.consignacion = response.data.data.consignaciones
        })
        .catch(error => {
         console.log( error.response.data);
        });
   },
   components: {
       "menu-item": menu_iems_pages
  },
  methods: {
     onChangeCuenta(event) {
       this.id_cuenta = event.target.value;
     },

     onChangeUsuario(event) {
       this.id_usuario = event.target.value;
     },

    register() {
      if (this.id_cuenta == null) {
        this.id_cuenta = this.consignacion.id_cuenta
      }
      if(this.id_usuario == null){
        this.id_usuario = this.consignacion.id_usuario
      } 
      this.$store
        .dispatch("updateConsignaciones", {
          id: this.consignacion.id,
          codigo_consignaciones: this.consignacion.codigo_consignaciones,
          valor_consignacion: this.consignacion.valor_consignacion,
          descripcion_consignacion: this.consignacion.descripcion_consignacion,
          id_usuario: this.id_usuario,
          id_cuenta: this.id_cuenta
        })
        .then(response => {
          this.$router.push({ name: "consignaciones" });
        })
        .catch(error => {
         console.log( error.response.data);
        });
    }
  },
 
};
</script>