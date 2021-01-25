<template>
  <div>
    <menu-item></menu-item>

    <div class="container">
      <div class="column is-4 is-offset-4">
        <div class="box">
          <h1 class="title">Registrar cuenta</h1>
          <div class="notification is-danger" v-if="error">
            <p>{{error}}</p>
          </div>
          <form autocomplete="off" @submit.prevent="register" method="post">
            
            <div class="field">
              <div class="control">
                <input type="text" class="input" placeholder="numero de cuenta" v-model="numero_cuenta" />
              </div>
            </div>

            <div class="field">
             
                <div class="select">
                  <select @change="onChange($event)">                  
                    <option>cliente</option>
                    <option v-for="cli in clientes" v-bind:key="cli.id" v-bind:value="cli.id"> {{ cli.nombres }} </option>
                  </select>
                </div>         
             
            </div>
             <div class="field">
              <div class="control">
                <input type="number" class="input" placeholder="saldo" v-model="saldo" />
              </div>
            </div>



           <div class="field" >
               <div class="control" v-for="act in mainActiva" v-bind:key="act.activa">
                  <label class="radio">
                    <input type="radio" name="answer"  :value="act.activa"  :id="act.activa" v-model="mainActiva.activa" @click="check($event)">
                     {{act.descripcion}}
                  </label>               
                </div>             
            </div> 


             <div class="field">
              <div class="control">
                <input type="number" class="input" placeholder="clave" v-model="clave_cuenta" />
              </div>
            </div>

            <div class="field">
              <div class="control">
                <textarea class="textarea" placeholder="Descripcion de la cuenta"  v-model="descripcion"></textarea>

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
      numero_cuenta: null,
      clientes:[],
      id_cliente:null,
      saldo: null,
      activa: null,
       mainActiva: [{
        activa: '1',
        descripcion: 'Activa'
      }, {
        activa: '2',
        descripcion: 'Inactiva'
      }],
      clave_cuenta: null,
      descripcion: null,
      error: null
    };
  },
    created() {
     this.$store
        .dispatch("listCliente", {

        }).then((res) => {
    
          this.clientes = res.data.data.clientes;
       
      }).catch((error) => {
        console.log(error);
      });    
  },
   components: {
       "menu-item": menu_iems_pages
  },
  methods: {
    
    check: function(e) {
      if (e.target.checked) {
        console.log(e.target.value)
      }
    },
    onChange(event) {
       this.id_cliente = event.target.value;
     },

    register() {
       this.$store
        .dispatch("registerCuenta", {
            numero_cuenta: this.numero_cuenta,
            id_cliente: this.id_cliente,
            saldo: this.saldo,
            activa: this.mainActiva.activa,
            clave_cuenta: this.clave_cuenta,
            descripcion: this.descripcion
        })
        .then(response => {
          console.log(response)
        // this.$router.push({ name: "cuentas" });
        })
        .catch(error => {
         this.error = error.response.data;
        });
    }
  },
};
</script>