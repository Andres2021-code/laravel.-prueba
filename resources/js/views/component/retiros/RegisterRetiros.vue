<template>
  <div>
    <menu-item></menu-item>

    <div class="container">
      <div class="column is-4 is-offset-4">
        <div class="box">
          <h1 class="title">Registrar retiros</h1>
          <div class="notification is-danger" v-if="error">
            <p>{{error}}</p>
          </div>
          <form autocomplete="off" @submit.prevent="register" method="post">
            
            <div class="field">
              <div class="control">
                <input type="text" class="input" placeholder="codigo" v-model="codigo_retiro" />
              </div>
            </div>

                <div class="field">
             
                <div class="select">
                  <select  @change="onChangeCuenta($event)" >                  
                    <option>selecciona un cuenta</option>
                    <option v-for="doc in cuentas" v-bind:key="doc.id" v-bind:value="doc.id"> {{ doc.descripcion }} </option>
                  </select>
                </div>         
             
            </div>

              <div class="field">
             
                <div class="select">
                  <select @change="onChangeUsuario($event)">                  
                    <option>selecciona un usuario</option>
                    <option v-for="user in users" v-bind:key="user.id" v-bind:value="user.id"> {{ user.nombre_usuario }} </option>
                  </select>
                </div>         
             
            </div>

          
             <div class="field">
              <div class="control">
                <input type="number" class="input" placeholder="valor retiro" v-model="valor_retiro" />
              </div>
            </div>

             <div class="field">
              <div class="control">
                <input type="text" class="input" placeholder="descripcion" v-model="descripcion" />
              </div>
            </div> 

          
            <button type="submit" class="button is-primary">Registrar</button>
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
      codigo_retiro: null,
      valor_retiro: null,
      descripcion: null,
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

      this.$store
        .dispatch("registerRetiros", {
          codigo_retiro: this.codigo_retiro,
          valor_retiro: this.valor_retiro,
          descripcion: this.descripcion,
         id_usuario: this.id_usuario,
         id_cuenta: this.id_cuenta
         
        })
        .then(response => {
          console.log(response)
          //this.$router.push({ name: "retiros" });
        })
        .catch(error => {
         console.log( error.response.data);
        });
    }
  },
};
</script>