<template>
  <div>
    <div class="container">
      <div class="column is-4 is-offset-4">
        <div class="box">
          <h1 class="title">Login</h1>
          <div class="notification is-danger" v-if="error">
            <p>{{error}}</p>
          </div>
          <form autocomplete="off" @submit.prevent="login" method="post">
            <div class="field">
             
                <div class="select">
                  <select>
                     
                    <option>seleccionar tipo de usuario</option>
                         <option v-for="user in type_user" v-bind:key="user.id" v-bind:value="user.id"> {{ user.nombre }} </option>
                  </select>
                </div>         
             
            </div>
             <div class="field">
              <div class="control">
                <input type="number" class="input" placeholder="123325" v-model="numero_documento" />
              </div>
            </div>
            <div class="field">
              <div class="control">
                <input type="email" class="input" placeholder="user@ejemplo.com" v-model="email" />
              </div>
            </div>
            <div class="field">
              <div class="control">
                <input type="password" class="input" v-model="password" />
              </div>
            </div>
            <button type="submit" class="button is-primary">Iniciar sesion</button>

            <button @click.prevent="registrar()" class="button is-success">registrase</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      type_user:[],
      email: null,
      password: null,
      numero_documento: null,
      error: null
    };
  },
  computed: {
      authErrors(){
          return this.$store.getters.authErrors;
      }
  },
    created() {
     this.$store
        .dispatch("listTypeUser", {

        }).then((res) => {
          console.log(res.data.data.tipo_usuario);
          this.type_user = res.data.data.tipo_usuario;
       
      }).catch((error) => {
        console.log(error);
      });    
  },
  methods: {

    registrar(){
       this.$router.push({ name: "registrarse" });
    },

    login() {
      this.$store
        .dispatch("retrieveToken", {

          email: this.email,
          password: this.password,
          usuario_cedula: this.numero_documento,
          tipo_id: this.type_user[0]['id']
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