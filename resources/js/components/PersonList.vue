<template>
  <layout-div>
    <div class="container">
      <h2 class="text-center mt-5 mb-3">Lista persone</h2>
      <div class="card">
        <div class="card-header">
          <button to="/create" class="btn btn-outline-primary" @click="goToCreate()">Crea Persona
            </button>
        </div>
        <div class="card-body">

          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Nome</th>
                <th>Cognome</th>
                <th>Data di nascita</th>
                <th>Sesso</th>
                <th>email</th>

                <th width="240px">Azioni</th>
              </tr>
            </thead>
            <tbody>

              <tr v-for="person in people" :key="person.id">
                <td>{{ person.firstname }}</td>
                <td>{{ person.lastname }}</td>
                <td>{{ person.birth_date }}</td>
                <td>{{ person.gender }}</td>
                <td>{{ person.email }}</td>
                <td>

                  <button class="btn btn-outline-success mx-1" @click="editPerson(person.id)"> Modifica </button>
                  <button @click="handleDelete(person.id)" class="btn btn-danger mx-1"> Elimina </button>
                </td>
              </tr>

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </layout-div>
</template>

<script>
import axios from 'axios';
import LayoutDiv from './LayoutDiv.vue';
import Swal from 'sweetalert2'

export default {
  name: 'PersonList',
  components: {
    LayoutDiv,
  },
  data() {
    return {
      people: [],
    };
  },
  created() {
    this.fetchPersonList();
  },
  methods: {
    fetchPersonList() {
      axios.get('/api/people')
        .then(response => {
          this.people = response.data.people;
          return response
        })
        .catch(error => {
          return error
        });
    },
    editPerson(id) {
      window.location.href = "/people/edit/" + id;
    },
    handleDelete(id) {

      axios.delete(`/api/people/${id}`)
        .then(response => {
          Swal.fire({
            icon: 'success',
            title: 'Persona eliminata con successo!',
            showConfirmButton: false,
            timer: 1500
          })
          this.fetchPersonList();
          return response
        })
        .catch(error => {
          Swal.fire({
            icon: 'error',
            title: "Si è verificato un errore !",
            showConfirmButton: false,
            timer: 1500
          })
          return error
        });

    },
    goToCreate() {
      window.location.href = "/people/create"
    }
  },
};
</script>
