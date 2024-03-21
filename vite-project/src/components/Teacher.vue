<template>
    <div class="container">
      <h2>Teacher Registation</h2>
      <form @submit.prevent="save">
      
        <div class="form-group">
            <label>Teacher name</label>
            <input type="text" v-model="teacher.name" class="form-control"  placeholder="Teacher name" />
        </div>

        <div class="form-group">
            <label>Teacher Age</label>
            <input type="number" v-model="teacher.age" class="form-control"  placeholder="Teacher Age"/>
        </div>
        
        <button type="submit" class="btn btn-primary">Save</button>
      </form>
 
 
<h2>Teacher View</h2>
      <table class="table table-dark">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">Age</th>
      <th scope="col">Option</th>
    </tr>
  </thead>

  <tbody>
    <tr v-for="teacher in result.data" v-bind:key="teacher.id">
          
          <td>{{ teacher.id }}</td>
          <td>{{ teacher.name }}</td>
          <td>{{ teacher.age }}</td>
          <td>
            <button type="button" class="btn btn-warning" @click="edit(teacher)"> Edit </button>
            <button type="button" class="btn btn-danger" @click="remove(teacher)"> Delete </button>
          </td>
        </tr>
  </tbody>
</table>
  <div>{{result}}</div>
    </div>

  </template>

  <script>
    
  import axios from 'axios';
  export default {
    name: 'Teacher',
    data () {
      return {
        result: {},
        teacher:{
          id: '',
          name: '',
          age: '',
        }
      }
    },
    created() { 
        this.TeacherLoad();
    },
    mounted() {
          console.log("mounted() called.......");
         
      },
 
    methods: {
      TeacherLoad(){
        var page = "http://127.0.0.1:8001/api/teachers";
        axios.get(page)
        .then(
              ({data})=>{
                console.log(data);
                this.result = data;
              }
        );
      },

      save(){
        if(this.teacher.id == ''){
          this.saveData();
        }
        else{
          this.updateData();
        }
      },
      saveData(){
        axios.post("http://127.0.0.1:8001/api/teachers", this.teacher)
        .then(
          ({data})=>{
            alert("saveddddd");
            this.TeacherLoad();
            this.teacher.name = '';
            this.teacher.age = '',
            this.id = ''
          }
        )
      },
      edit(teacher){
        this.teacher = teacher;
      },
      updateData(){
        var editrecords = 'http://127.0.0.1:8001/api/teachers/'+ this.teacher.id;
        axios.put(editrecords, this.teacher)
        .then(
          ({data})=>{
            this.teacher.name = '';
            this.teacher.age = '',
            this.id = ''
            alert("Updated!!!");
            this.TeacherLoad();
          }
        );
      },
 
      remove(teacher){
        var url = `http://127.0.0.1:8001/api/teachers/${teacher.id}`;
        axios.delete(url);
        alert("Deleteddd");
        this.TeacherLoad();
      }
    }
  }
  </script>