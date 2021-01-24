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

      listTypeDoc(){
        return new Promise((resolve, reject) => {
        axios.get('/api/listTypeDoc', {
  
        }).then(response => {
         // console.log(response.data.data.tipo_usuario)  
          resolve(response)
        })
        .catch(error => {
          console.log(error)
          reject(error)
        })})
      
        
      },

      listOne(context, data){
        return new Promise((resolve, reject) => {
          axios.get('/api/cliente/'+ data.id, {
    
          }).then(response => {
           // console.log(response.data.data.tipo_usuario)  
            resolve(response)
          })
          .catch(error => {
            console.log(error)
            reject(error)
          })})
        
          
      },
     
      registerCliente(context, data){
      
        return new Promise((resolve, reject) => {
          axios.post('/api/cliente', {
            nombres: data.nombre,
            apellidos: data.apellido,
            numero_cedula: data.numero_cedula,
            direccion: data.direccion,
            telefono: data.telefono,
            email: data.email,
            tipo_doc: Number(data.tipo_doc)
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
      
      updateCliente(context, data){
      
        return new Promise((resolve, reject) => {
          axios.put('/api/cliente', {
            id: data.id,
            nombres: data.nombre,
            apellidos: data.apellido,
            numero_cedula: data.numero_cedula,
            direccion: data.direccion,
            telefono: data.telefono,
            email: data.email,
            tipo_doc: Number(data.tipo_doc)
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
      
      
      deleteCliente(context, data){
        return new Promise((resolve, reject) => {
          axios.delete('/api/cliente/'+ data.id, {

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