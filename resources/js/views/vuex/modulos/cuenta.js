import axios from 'axios'

  const state = {
    status: ''
  }

  const mutations = {
   
  }

  const actions = {
    listCuenta(){
        return new Promise((resolve, reject) => {
        axios.get('/api/cuenta', { 
        }).then(response => {    
          resolve(response)
        })
        .catch(error => {
          reject(error)
        })})
      
        
      },


      listOneCuenta(context, data){
        return new Promise((resolve, reject) => {
          axios.get('/api/cuenta/'+ data.id, {
    
          }).then(response => {
           // console.log(response.data.data.tipo_usuario)  
            resolve(response)
          })
          .catch(error => {
            console.log(error)
            reject(error)
          })})
        
          
      },
     
      registerCuenta(context, data){

     return new Promise((resolve, reject) => {
          axios.post('/api/cuenta', {
            numero_cuenta: data.numero_cuenta,
            id_cliente: data.id_cliente,
            saldo: data.saldo,
            activa: data.activa,
            clave_cuenta: data.clave_cuenta,
            descripcion: data.descripcion
          })
            .then(response => {
              resolve(response)
            })
            .catch(error => {
              //console.log(error)
              reject(error)
            })
        })
      },
      
      updateCuentas(context, data){
      
        return new Promise((resolve, reject) => {
          axios.put('/api/cuenta', {
            id: data.id,
            numero_cuenta: data.numero_cuenta,
            id_cliente: Number(data.id_cliente),
            saldo: data.saldo,
            activa: data.activa,
            clave_cuenta: data.clave_cuenta,
            descripcion: data.descripcion
          })
            .then(response => {
             
              resolve(response)
            })
            .catch(error => {
              //console.log(error)
              reject(error)
            })
        })
      },
      
      
      deleteCuenta(context, data){
        return new Promise((resolve, reject) => {
          axios.delete('/api/cuenta/'+ data.id, {

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