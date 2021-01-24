<template>
  <div>
    <menu-item></menu-item>

    <div class="container">
      <div class="column is-4 is-offset-4">
        <div class="box">
          <h1 class="title">Registrar cliente</h1>
          <div class="notification is-danger" v-if="error">
            <p>{{error}}</p>
          </div>
          <form autocomplete="off" @submit.prevent="register" method="post">
            
            <div class="field">
              <div class="control">
                <input type="text" class="input" placeholder="nombre" v-model="nombre" />
              </div>
            </div>

              <div class="field">
              <div class="control">
                <input type="text" class="input" placeholder="apellido" v-model="apellido" />
              </div>
            </div>


            <div class="field">
             
                <div class="select">
                  <select>                  
                    <option>tipo de documento</option>
                    <option v-for="doc in type_doc" v-bind:key="doc.id" v-bind:value="doc.id"> {{ doc.nombre_doc }} </option>
                  </select>
                </div>         
             
            </div>
             <div class="field">
              <div class="control">
                <input type="number" class="input" placeholder="cedula" v-model="numero_cedula" />
              </div>
            </div>

             <div class="field">
              <div class="control">
                <input type="text" class="input" placeholder="direccion" v-model="direccion" />
              </div>
            </div> 

             <div class="field">
              <div class="control">
                <input type="number" class="input" placeholder="telefono" v-model="telefono" />
              </div>
            </div>

            <div class="field">
              <div class="control">
                <input type="email" class="input" placeholder="usuario@ejemplo.com" v-model="email" />
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
      type_doc:[],
      nombre: null,
      apellido: null,
      numero_cedula: null,
      direccion: null,
      telefono: null,
      email: null,
      error: null
    };
  },
    created() {
     this.$store
        .dispatch("listTypeDoc", {

        }).then((res) => {
          console.log(res.data.data.tipo_documento);
          this.type_doc = res.data.data.tipo_documento;
       
      }).catch((error) => {
        console.log(error);
      });    
  },
   components: {
       "menu-item": menu_iems_pages
  },
  methods: {

    register() {
        console.log(this.type_doc[0]['id']);
      this.$store
        .dispatch("registerCliente", {
          nombre: this.nombre,
          apellido: this.apellido,
          numero_cedula: this.numero_cedula,
          direccion: this.direccion,
          telefono: this.telefono,
          email: this.email,
          tipo_doc: this.type_doc[0]['id']
        })
        .then(response => {
          this.$router.push({ name: "dashboard" });
        })
        .catch(error => {
         console.log( error.response.data);
        });
    }
  },
};
</script>