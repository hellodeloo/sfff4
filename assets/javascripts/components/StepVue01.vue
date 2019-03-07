<template>

  <div>
    <p>{{ msg }}</p>
    <form name="answers" id="answers" v-on:submit.prevent="saveSessionStep">
      <div class="form-group">
        <label for="question" class="required">Question</label>
        <input type="text" id="question" name="question" v-model="question" class="form-control">
      </div>
      <div class="form-group">
        <label for="answer" class="required">Réponse</label>
        <input type="text" id="answer" name="answer" v-model="answer" class="form-control">
      </div>
      <div class="form-group">
        <label class="required" for="priority">Priorité</label>
        <select id="priority" name="priority" class="form-control" v-model="priority">
          <option disabled value="">Choisissez</option>
          <option v-for="priority in priorities">{{ priority }}</option>
        </select>
      </div>
      <div class="form-group">
        <span>{{ question }}</span><br>
        <span>{{ answer }}</span><br>
        <span>{{ priority }}</span>
      </div>
      <div class="form-group">
        <button class="btn btn-primary">Etape suivante</button>
      </div>
    </form>
  </div>

</template>


<script>
  export default {
    data: function () {
      return {
        msg: 'stepVue01',
        question: '',
        answer: '',
        priority: '',
        priorities: [
          'Basse',
          'Moyenne',
          'Haute'
        ]
      }
    },
    methods: {
      saveSessionStep() {
        axios.post('/contest/v02', {
          question: this.question,
          answer: this.answer,
          priority: this.priority
        }).then(response => {
          console.log(response);
          if(response.data === 'ok') {
            this.$router.push({ name: 'StepVue02'})
          }
        })
      }
    }
  }
</script>
