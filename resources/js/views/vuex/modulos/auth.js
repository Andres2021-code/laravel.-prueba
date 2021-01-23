import axios from 'axios'

const state = {
    token: localStorage.getItem('access_token') || null
}


 const getters = {
    loggedIn(state) {
        return state.token !== null
    }
 }

  const mutations = {
    retrieveToken(state, token) {
      state.token = token
    },
    destroyToken(state) {
      state.token = null
    }
    
  }
  const actions = {
    registerUser(context, data){
      
      return new Promise((resolve, reject) => {
        axios.post('/api/register', {
          nombre_usuario: data.nombre_usuario,
          usuario_cedula: data.usuario_cedula,
          email: data.email,
          password: data.password,
          tipo_id: Number(data.tipo_id)
        })
          .then(response => {
            console.log(response)
            resolve(response)
          })
          .catch(error => {
            //console.log(error)
            reject(error)
          })
      })
    },
    retrieveToken(context, credentials) {

      return new Promise((resolve, reject) => {
        axios.post('/api/login', {
          email: credentials.email,
          password: credentials.password,
          usuario_cedula: credentials.usuario_cedula,
          tipo_id: credentials.tipo_id,
        })
          .then(response => {
            //console.log(response)
            const token = response.data.access_token
            localStorage.setItem('access_token', token)
            context.commit('retrieveToken', token)

            resolve(response)
          })
          .catch(error => {
            //console.log(error)
            reject(error)
          })
      })

    },
    listTypeUser(){
      return new Promise((resolve, reject) => {
      axios.get('/api/listtypeuser', {

      }).then(response => {
       // console.log(response.data.data.tipo_usuario)  
        resolve(response)
      })
      .catch(error => {
        console.log(error)
        reject(error)
      })})
    
      
    },

    destroyToken(context) {
      
      if (context.getters.loggedIn){
        
        return new Promise((resolve, reject) => {
          axios.post('/api/logout', '', {
              headers: { Authorization: "Bearer " + context.state.token }
            })
            .then(response => {
              //console.log(response)
              localStorage.removeItem('access_token')
              context.commit('destroyToken')
  
              resolve(response)
            })
            .catch(error => {
              //console.log(error)
              localStorage.removeItem('access_token')
              context.commit('destroyToken')

              reject(error)
            })
        })

      }}}
      export default {
        state,
        getters,
        actions,
        mutations,
    }