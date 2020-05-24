<template>
  <div class="card card-profile">
    <div class="card-body text-center">
      <div class="form-group">
        <div
          class="form-label"
          v-text="question.name"
        />
        <div class="custom-controls-stacked">
          <label
            v-for="i in 10"
            :key="i"
            class="custom-control custom-radio custom-control-inline"
          >
            <input
              v-model="rating"
              type="radio"
              class="custom-control-input"
              :value="i"
              @change="onSaveButtonClicked"
            >
            <span
              class="custom-control-label"
              v-text="i"
            />
          </label>
        </div>
      </div>
      <div class="form-group">
        <div class="input-group">
          <input
            v-model="answer"
            type="text"
            class="form-control"
            placeholder="What candidate said..."
          >
          <span class="input-group-append">
            <button
              class="btn btn-primary"
              type="button"
              @click="onSaveButtonClicked"
            >Save</button>
          </span>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
    import Form from 'form-object';

    export default {
        props: {
            question: {
                required: true,
                type: Object
            }
        },
        data () {
            return {
                request: new Form,
                rating: this.question.answer ? this.question.answer.rating : null,
                answer: this.question.answer ? this.question.answer.answer : null,
            }
        },
        methods: {
            onSaveButtonClicked () {
                let url = `/api/v1/my/interviews/${this.$route.params.id}/questions/${this.question.id}`;


                this.request.post(url, {
                    rating: this.rating,
                    answer: this.answer
                }).then(() => {
                    this.question.answer = this.question.answer || {};
                    this.question.answer.rating = this.rating;
                    this.question.answer.answer = this.answer;
                }).catch(() => {
                    alert("Unable to save!");
                })
            }
        }
    }
</script>
