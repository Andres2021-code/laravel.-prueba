import axios from 'axios'

  const state = {
    status: ''
  }

  const mutations = {
   
  }

  const actions = {
    listConsignaciones(){
        return new Promise((resolve, reject) => {
        axios.get('/api/consignaciones', {
  
        }).then(response => {
         // console.log(response.data.data.tipo_usuario)  
          resolve(response)
        })
        .catch(error => {
          console.log(error)
          reject(error)
        })})
      
        
      },
      listConsignacionesUser(){
        return new Promise((resolve, reject) => {
        axios.get('/api/consignaciones/user', {
  
        }).then(response => {
         // console.log(response.data.data.tipo_usuario)  
          resolve(response)
        })
        .catch(error => {
          console.log(error)
          reject(error)
        })})
      
        
      },


      listOneConsignaciones(context, data){
        return new Promise((resolve, reject) => {
          axios.get('/api/consignaciones/'+ data.id, {
    
          }).then(response => {
           // console.log(response.data.data.tipo_usuario)  
            resolve(response)
          })
          .catch(error => {
            console.log(error)
            reject(error)
          })})
        
          
      },
     
      registerConsignaciones(context, data){
      
        return new Promise((resolve, reject) => {
          axios.post('/api/consignaciones', {
            codigo_consignaciones: data.codigo_consignaciones,
            valor_consignacion: data.valor_consignacion,
            descripcion_consignacion: data.descripcion_consignacion,
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
      
      updateConsignaciones(context, data){      
        return new Promise((resolve, reject) => {
          axios.put('/api/consignaciones', {
            id: data.id,
            codigo_consignaciones: data.codigo_consignaciones,
            valor_consignacion: data.valor_consignacion,
            descripcion_consignacion: data.descripcion_consignacion,
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
      
      
      deleteConsignaciones(context, data){
        return new Promise((resolve, reject) => {
          axios.delete('/api/consignaciones/'+ data.id, {

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