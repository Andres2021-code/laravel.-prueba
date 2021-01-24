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
      
      updateCuenta(context, data){
      
        return new Promise((resolve, reject) => {
          axios.put('/api/cuenta', {
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