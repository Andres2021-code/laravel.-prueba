<template>
  <div>
    <menu-item></menu-item>

    <div class="container">
      <div class="column is-4 is-offset-4">
        <div class="box">
          <h1 class="title">Actualizar cuenta</h1>
          <div class="notification is-danger" v-if="error">
            <p>{{error}}</p>
          </div>
          <form autocomplete="off" @submit.prevent="register" method="post">

             <input type="hidden" class="input" placeholder="nombre" v-model="cuentas.id" />

           <div class="field">
              <div class="control">
                <input type="text" class="input" placeholder="numero de cuenta" v-model="cuentas.numero_cuenta" />
              </div>
            </div>

            <div class="field">
             
                <div class="select">
                  <select @change="onChange($event)" :value="cuentas.id_cliente">                  
                    <option>clientes</option>
                    <option v-for="cli in clientes" v-bind:key="cli.id" v-bind:value="cli.id"> {{ cli.nombres }} </option>
                  </select>
                </div>         
             
            </div>
             <div class="field">
              <div class="control">
                <input type="number" class="input" placeholder="saldo" v-model="cuentas.saldo" />
              </div>
            </div>

           <div class="field" >
               <div class="control">
                  <label class="radio"  v-for="act in mainActiva" v-bind:key="act.activa">
                    <input type="radio"  :value="act.activa"  :id="act.activa"  @click="check($event)"  :checked="act.activa == cuentas.activa">
                     {{act.descripcion}}
                  </label>
                
                </div>
             

            </div> 

             <div class="field">
              <div class="control">
                <input type="number" class="input" placeholder="clave" v-model="cuentas.clave_cuenta" />
              </div>
            </div>

            <div class="field">
              <div class="control">
              <textarea class="textarea" placeholder="Descripcion de la cuenta"  v-model="cuentas.descripcion"></textarea>
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
      clientes:[],
      cliente_id: null,
      cuentas: [],
      mainActiva: [{
        activa: '1',
        descripcion: 'Activa'
      }, {
        activa: '2',
        descripcion: 'Inactiva'
      }],
      checked:null,
      error: null
    };
  },
    created() {
     this.$store
        .dispatch("listCliente", {
        }).then((res) => {
       this.clientes = res.data.data.clientes
       
      }).catch((error) => {
        this.error = error;
      });    
       this.$store
        .dispatch("listOneCuenta", {
          id: this.$route.params.id,    
        })
        .then(response => {
          this.cuentas = response.data.data.cuenta
          this.checked = this.cuentas.activa
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
       this.cliente_id = event.target.value;
   },
   check: function(e) {
      if (e.target.checked) {
        this.cuentas.activa = e.target.value
      }
    },

    register() {
     if (this.cliente_id == null) {
        this.cliente_id = this.cuentas.id_cliente
      }
      
      this.$store
        .dispatch("updateCuentas", {
            id: this.cuentas.id,
            numero_cuenta: this.cuentas.numero_cuenta,
            id_cliente: this.cliente_id,
            saldo: this.cuentas.saldo,
            activa: this.cuentas.activa,
            clave_cuenta: this.cuentas.clave_cuenta,
            descripcion: this.cuentas.descripcion
        })
        .then(response => {
          this.$router.push({ name: "cuentas" });
        })
        .catch(error => {
         console.log( error.response.data);
        });
    }
  },
 
};
</script>