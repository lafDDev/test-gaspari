<template>
  <layout-div>
    <div class="container">
      <h2 class="text-center mt-5 mb-3">Lista persone</h2>
      <div class="card">
        <div class="card-header">
          <button to="/create" class="btn btn-primary" @click="goToCreate()">Crea Persona
          </button>
        </div>
        <div class="card-body">

          <table class="table table-bordered">
            <thead>
              <tr>
                <th class="text-center">Nome</th>
                <th class="text-center">Cognome</th>
                <th class="text-center">Data di nascita</th>
                <th class="text-center">Sesso</th>
                <th class="text-center">email</th>

                <th class="px-2">Azioni</th>
              </tr>
            </thead>
            <tbody>

              <tr v-for="person in people" :key="person.id">
                <td>{{ person.firstname }}</td>
                <td>{{ person.lastname }}</td>
                <td>{{ person.birth_date | formatDate }}</td>
                <td class="text-center">{{ person.gender }}</td>
                <td>{{ person.email }}</td>
                <td>

                  <button class="btn btn-outline-success mx-1" @click="editPerson(person.id)"> Modifica </button>
                  <button @click="handleDelete(person.id)" class="btn btn-danger mx-1"> Elimina </button>
                </td>
              </tr>

            </tbody>
          </table>
          <b-pagination v-model="pagination.currentPage" :total-rows="pagination.rows" :per-page="pagination.perPage"
            first-text="Prima" prev-text="Prec" next-text="Succ" last-text="Ultima"
            v-on:input="chengePage"></b-pagination>
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
      pagination: {
        rows: 0,
        perPage: 0,
        currentPage: 1
      }
    };
  },
  created() {
    this.fetchPersonList(1);
  },
  methods: {
    fetchPersonList(page) {
      axios.get(`/api/people?page=${page}`)
        .then(response => {
          this.people = response.data.people.data;
          this.pagination.currentPage = response.data.people.current_page
          this.pagination.rows = response.data.people.total
          this.pagination.perPage = response.data.people.per_page
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
          this.fetchPersonList(1);
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
    chengePage(e) {
      this.fetchPersonList(e)
    },
    goToCreate() {
      window.location.href = "/people/create"
    }
  },
  filters: {
    formatDate: function (value) {
      let date = new Date(value)
      return date.toLocaleDateString("it-IT")
    }
  }
};
</script>
