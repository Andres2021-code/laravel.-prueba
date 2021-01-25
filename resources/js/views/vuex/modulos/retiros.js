import axios from 'axios'

  const state = {
    status: ''
  }

  const mutations = {
   
  }

  const actions = {
    listRetiros(){
      return new Promise((resolve, reject) => {
      axios.get('/api/retiros', {

      }).then(response => {
       // console.log(response.data.data.tipo_usuario)  
        resolve(response)
      })
      .catch(error => {
        console.log(error)
        reject(error)
      })})
    
      
    },
    listretiRosUser(){
      return new Promise((resolve, reject) => {
      axios.get('/api/retiros/user', {

      }).then(response => {
       // console.log(response.data.data.tipo_usuario)  
        resolve(response)
      })
      .catch(error => {
        console.log(error)
        reject(error)
      })})
    
      
    },


    listOneRetiros(context, data){
      return new Promise((resolve, reject) => {
        axios.get('/api/retiros/'+ data.id, {
  
        }).then(response => {
         // console.log(response.data.data.tipo_usuario)  
          resolve(response)
        })
        .catch(error => {
          console.log(error)
          reject(error)
        })})
      
        
    },
   
    registerRetiros(context, data){

      return new Promise((resolve, reject) => {
        axios.post('/api/retiros', {
          codigo_retiro: data.codigo_retiro,
          valor_retiro: data.valor_retiro,
          descripcion: data.descripcion,
         id_usuario: Number(data.id_usuario),
         id_cuenta: Number(data.id_cuenta)
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
    
    updateRetiros(context, data){      
      return new Promise((resolve, reject) => {
        axios.put('/api/retiros', {
          id: data.id,
          codigo_retiro: data.codigo_retiro,
          valor_retiro: data.valor_retiro,
          descripcion: data.descripcion,
         id_usuario: Number(data.id_usuario),
         id_cuenta: Number(data.id_cuenta)
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
    
    
    deleteRetiros(context, data){
      return new Promise((resolve, reject) => {
        axios.delete('/api/retiros/'+ data.id, {

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