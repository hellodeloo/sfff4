<template>

  <form name="players" id="players" v-on:submit.prevent="saveSessionFinal">
    <div class="form-group">
      <label for="firstname">Prénom</label>
      <input type="text" id="firstname" name="firstname" v-model="firstname" class="form-control">
    </div>
    <div class="form-group">
      <label for="lastname">Nom</label>
      <input type="text" id="lastname" name="lastname" v-model="lastname" class="form-control">
    </div>
    <div class="form-group">
      <label for="email">Email</label>
      <input type="email" id="email" name="email" v-model="email" class="form-control">
    </div>
    <div class="form-group">
      <label for="address">Address</label>
      <input type="text" id="address" name="address" v-model="address" class="form-control">
    </div>
    <div class="form-group">
      <label for="postal_code">Postal code</label>
      <input type="text" id="postal_code" name="postal_code" v-model="postal_code" class="form-control">
    </div>
    <div class="form-group">
      <label for="city">City</label>
      <input type="text" id="city" name="city" v-model="city" class="form-control">
    </div>
    <div class="form-group">
      <button class="btn btn-primary">Etape suivante</button>
    </div>
  </form>

</template>


<script>
  export default {
    data: function () {
      return {
        msg: 'stepVue03',
        firstname: '',
        lastname: '',
        email: '',
        address: '',
        postal_code: '',
        city: '',
      }
    },
    methods: {
      saveSessionFinal() {
        axios.post('/contest/v04', {
          firstname: this.firstname,
          lastname: this.lastname,
          email: this.email,
          address: this.address,
          postal_code: this.postal_code,
          city: this.city
        }).then(response => {
          if(response.data === 'ok') {
            location.href='http://127.0.0.1:8000';
          }
        })
      }
    }
  }
</script>
