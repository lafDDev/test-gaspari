<template>
  <layout-div>
    <h2 class="text-center mt-5 mb-3">Modifica dati persona </h2>
    <div class="card">
      <div class="card-header">
      </div>
      <div class="card-body">
        <form>
          <div class="form-group">
            <label htmlFor="firstname">Nome</label>
            <input v-model="person.firstname" type="text" class="form-control" id="name" name="name"
              :class="{ 'border border-danger': (validationErrors.firstname != null) }"
              @focus="validationErrors.firstname = null" />
            <span class="help-block text-danger" v-show="validationErrors.firstname != null">{{
              this.validationErrors.firstname }}</span>
          </div>

          <div class="form-group">
            <label htmlFor="lastname">Cognome</label>
            <input v-model="person.lastname" type="text" class="form-control" id="lastname" name="lastname"
              :class="{ 'border border-danger': (validationErrors.lastname != null) }"
              @focus="validationErrors.lastname = null" />
            <span class="help-block text-danger" v-show="validationErrors.lastname != null">{{
              this.validationErrors.lastname }}</span>
          </div>
          <div class="form-group">
            <label htmlFor="birth_date">Data di nascita</label>
            <b-form-datepicker id="example-datepicker" class="form-control mb-2" v-model="person.birth_date" locale="it"
              menu-class="w-75" calendar-width="75%"
              :date-format-options="{ year: 'numeric', month: 'numeric', day: 'numeric' }" :min="minDate"
              :max="maxDate"></b-form-datepicker
              :class="{'border border-danger': (validationErrors.birth_date != null) }" :state="datePickerState"
              @shown="validationErrors.birth_date = null">
            <span class="help-block text-danger" v-show="validationErrors.birth_date != null">{{
              this.validationErrors.birth_date }}</span>
          </div>
          <div class="form-group">
            <label htmlFor="gender">Sesso</label>
            <select class="form-control" v-model="person.gender"
              :class="{ 'border border-danger': (validationErrors.gender != null) }"
              @focus="validationErrors.gender = null">
              <option value="M">M</option>
              <option value="F">F</option>
            </select>
            <span class="help-block text-danger" v-show="validationErrors.gender != null">{{
              this.validationErrors.gender }}</span>

          </div>
          <div class="form-group">
            <label htmlFor="email">Indirizzo mail</label>
            <input v-model="person.email" type="email" class="form-control" id="email" name="email"
              :class="{ 'border border-danger': (validationErrors.email != null) }"
              @focus="validationErrors.email = null" />
            <span class="help-block text-danger" v-show="validationErrors.email != null">{{
              this.validationErrors.email }}</span>
          </div>

          <button @click="handleSave()" :disabled="isSaving" type="button" class="btn btn-outline-primary mt-3">
            Salva Modifiche
          </button>
        </form>

      </div>
    </div>
    <b-alert :show="validationErrors.response != null" dismissible fade variant="danger" class="fixed-top">{{
              this.validationErrors.response }}</b-alert>
  </layout-div>
</template>

<script>
import axios from 'axios';
import LayoutDiv from './LayoutDiv.vue';
import Swal from 'sweetalert2'

export default {
  name: 'PersonEdit',
  components: {
    LayoutDiv,
  },
  props: {
    personId: {
      type: String,
      required: true
    },
  },
  data() {
    const now = new Date()
    const today = new Date(now.getFullYear(), now.getMonth(), now.getDate())
    const minDate = new Date(today)
    minDate.setYear(minDate.getYear() - 120)
    const maxDate = new Date(today)

    return {
      person: {
        firstname: '',
        lastname: '',
        birth_date: '',
        gender: '',
        email: ''
      },
      maxDate: maxDate,
      minDate: minDate,
      isSaving: false,
      validationErrors: {
        firstname: null,
        lastname: null,
        birth_date: null,
        gender: null,
        email: null,
        response: null
      },

    };
  },
  created() {
    axios.get(`/api/people/${this.personId}`)
      .then(response => {
        let personInfo = response.data
        this.person.firstname = personInfo.firstname
        this.person.lastname = personInfo.lastname
        this.person.birth_date = personInfo.birth_date
        this.person.gender = personInfo.gender
        this.person.email = personInfo.email
        return response
      })
      .catch(error => {
        Swal.fire({
          icon: 'error',
          title: 'An Error Occured!',
          showConfirmButton: false,
          timer: 1500
        })
        return error
      })
  },
  computed: {
    datePickerState() {
      return this.validationErrors.birth_date != null ? false : null
    }
  },
  methods: {
    handleSave() {
      if (!this.validateForm()) {
        return
      }
      this.isSaving = true
      axios.put(`/api/people/${this.personId}`, this.person)
        .then(response => {
          Swal.fire({
            icon: 'success',
            title: 'Dati aggiornati con successo!',
            showConfirmButton: false,
            timer: 1500
          })
          this.isSaving = false
          return response
        })
        .catch(error => {
          this.isSaving = false

          if (error.response.data.errors.email[0] == "The email has already been taken."){
            this.validationErrors.email = 'Questa mail è già stata utilizzata'
          } else {
            this.validationErrors.response = error.response.data.errors
          }
          
          return error
        });
    },
    validateForm() {

      let foundError = false
      this.validationErrors = {
        firstname: null,
        lastname: null,
        birth_date: null,
        gender: null,
        email: null,
        response: null
      }
      if (!this.person.firstname.trim()) {
        this.validationErrors.firstname = 'Il nome è un campo obbligatorio'
        foundError = true
      }
      if (!this.person.lastname.trim()) {
        this.validationErrors.lastname = 'Il cognome è un campo obbligatorio'
        foundError = true
      }
      if (!this.person.birth_date.trim()) {
        this.validationErrors.birth_date = '  La data di nascita è un campo obbligatorio'
        foundError = true
      }
      if (!this.person.gender.trim()) {
        this.validationErrors.gender = 'Il sesso è un campo obbligatorio'
        foundError = true
      }
      if (!this.person.email.trim()) {
        this.validationErrors.email = 'La mail è un campo obbligatorio'
        foundError = true
      }

      return !foundError
    }
  },

};
</script>