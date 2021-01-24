<template>
  <div>  
      <nav class="navbar" role="navigation" aria-label="main navigation">
  <div class="navbar-brand">
    <a class="button is-large">
      Eccodet
    </a>

    <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
    </a>
  </div>

  <div id="navbarBasicExample" class="navbar-menu">
    <div class="navbar-start">
      <router-link to="/dashboard" class="navbar-item">
        clientes
      </router-link>

     <router-link to="/cuentas" class="navbar-item">
        Cuentas
      </router-link>

      <a class="navbar-item">
        consignaciones
      </a>

     <a class="navbar-item">
        retiros
      </a>

     
    </div>

    <div class="navbar-end">
      <div class="navbar-item">
        <div class="buttons">
          <a class="button is-primary">
            <strong>Cerrar sesión</strong>
          </a>
         
        </div>
      </div>
    </div>
  </div>
</nav>
  </div>
</template>

<script>
export default {
    name: 'menu_iems_pages',
}
</script>

<style>

</style>