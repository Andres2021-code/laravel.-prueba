<template>
  <div>
    <div class="container">
      <div class="column is-4 is-offset-4">
        <div class="box">
          <h1 class="title">Registrate</h1>
          <div class="notification is-danger" v-if="error">
            <p>{{error}}</p>
          </div>
          <form autocomplete="off" @submit.prevent="register" method="post">
            
            <div class="field">
              <div class="control">
                <input type="text" class="input" placeholder="nombre" v-model="nombre_usuario" />
              </div>
            </div>

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
                <input type="number" class="input" placeholder="cedula" v-model="usuario_cedula" />
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
            <button type="submit" class="button is-primary">Registrar</button>
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
      nombre_usuario: null,
      email: null,
      password: null,
      usuario_cedula: null,
      error: null
    };
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

    register() {
        console.log(this.type_user[0]['id']);
      this.$store
        .dispatch("registerUser", {
          email: this.email,
          password: this.password,
          nombre_usuario: this.nombre_usuario,
          usuario_cedula: this.usuario_cedula,
          tipo_id: this.type_user[0]['id']
        })
        .then(response => {
          this.$router.push({ name: "login" });
        })
        .catch(error => {
         console.log( error.response.data);
        });
    }
  },
};
</script>