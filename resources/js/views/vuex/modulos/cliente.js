import axios from 'axios'

  const state = {
    status: ''
  }

  const mutations = {
   
  }

  const actions = {
    listCliente(){
        return new Promise((resolve, reject) => {
        axios.get('/api/cliente', {
  
        }).then(response => {
         // console.log(response.data.data.tipo_usuario)  
          resolve(response)
        })
        .catch(error => {
          console.log(error)
          reject(error)
        })})
      
        
      },


    
  }

  export default {
    state,
    actions,
    mutations,
}