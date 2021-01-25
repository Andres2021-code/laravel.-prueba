<template>
  <div>
    <menu-item></menu-item>

    <div class="container">
      <div class="column is-4 is-offset-4">
        <div class="box">
          <h1 class="title">Actualizar cliente</h1>
          <div class="notification is-danger" v-if="error">
            <p>{{error}}</p>
          </div>
          <form autocomplete="off" @submit.prevent="register" method="post">

             <input type="hidden" class="input" placeholder="nombre" v-model="cliente.id" />

            <div class="field">
              <div class="control">
                <input type="text" class="input" placeholder="nombre" v-model="cliente.nombres" />
              </div>
            </div>

              <div class="field">
              <div class="control">
                <input type="text" class="input" placeholder="apellido" v-model="cliente.apellidos" />
              </div>
            </div>


            <div class="field">
             
                <div class="select">
                  <select @change="onChange($event)"  :value="cliente.tipo_doc">                  
                    <option>tipo de documento</option>
                    <option v-for="doc in type_doc" v-bind:key="doc.id" v-bind:value="doc.id"> {{ doc.nombre_doc }} </option>
                  </select>
                </div>         
             
            </div>
             <div class="field">
              <div class="control">
                <input type="number" class="input" placeholder="cedula" v-model="cliente.numero_cedula" />
              </div>
            </div>

             <div class="field">
              <div class="control">
                <input type="text" class="input" placeholder="direccion" v-model="cliente.direccion" />
              </div>
            </div> 

             <div class="field">
              <div class="control">
                <input type="number" class="input" placeholder="telefono" v-model="cliente.telefono" />
              </div>
            </div>

            <div class="field">
              <div class="control">
                <input type="email" class="input" placeholder="usuario@ejemplo.com" v-model="cliente.email" />
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
      type_doc:[],
      doc_id: null,
      cliente: [],
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
        this.error = error;
      });    
       this.$store
        .dispatch("listOne", {

          id: this.$route.params.id,
      
        })
        .then(response => {
          this.cliente = response.data.data.cliente
        })
        .catch(error => {
         console.log( error.response.data);
        });
   },
   components: {
       "menu-item": menu_iems_pages
  },
  methods: {
    onChange(event) {
       this.doc_id = event.target.value;
    },
    register() {
     if (this.doc_id == null) {
        this.doc_id = this.cliente.tipo_doc
      }
      this.$store
        .dispatch("updateCliente", {
          id: this.cliente.id,
          nombre: this.cliente.nombres,
          apellido: this.cliente.apellidos,
          numero_cedula: this.cliente.numero_cedula,
          direccion: this.cliente.direccion,
          telefono: this.cliente.telefono,
          email: this.cliente.email,
          tipo_doc: this.doc_id
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