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
                    <option>Select dropdown</option>
                    <option>With options</option>
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
                <input type="email" class="input" placeholder="user@ejemplo.com" v-model="username" />
              </div>
            </div>
            <div class="field">
              <div class="control">
                <input type="password" class="input" v-model="password" />
              </div>
            </div>
            <button type="submit" class="button is-primary">Sign in</button>
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
      username: null,
      password: null,
      numero_documento: null,
      error: null
    };
  },
  methods: {
    login() {
      this.$store
        .dispatch("retrieveToken", {
          username: this.username,
          password: this.password,
          numero_documento: this.numero_documento
        })
        .then(response => {
          this.$router.push({ name: "dashboard" });
        })
        .catch(error => {
         console.log( error.response.data);
        });
    }
  }
};
</script>