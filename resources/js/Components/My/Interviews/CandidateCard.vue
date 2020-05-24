<template>
  <div class="card card-profile">
    <div class="card-body text-center">
      <h3
        class="mb-3"
        v-text="candidate.name"
      />
      <p
        class="mb-4"
        v-text="candidate.position.name"
      />
      <span
        v-for="tag in tags"
        :key="tag"
        class="tag mr-2"
        v-text="tag"
      />
      <div class="mt-5">
        <router-link
          :to="interviewLink"
          class="btn btn-outline-primary btn-md"
        >
          <span class="fa fa-twitter" /> Start Interview
        </router-link>
      </div>
    </div>
  </div>
</template>

<script>
    import collect from 'collect.js';
    export default {
        props: {
            candidate: {
                required: true,
                type: Object
            },
            interviewId: {
                required: true,
                type: Number
            }
        },
        computed: {
            tags () {
                return collect(this.candidate.technology_stack)
                    .pluck('name');
            },
            interviewLink() {
                return `/my/interviews/${this.interviewId}`;
            }
        }
    }
</script>

<style>
    h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6 {
        margin-bottom: 0.66em;
        font-family: inherit;
        font-weight: 600;
        line-height: 1.1;
        color: inherit;
    }
    h3, .h3 {
        font-size: 1.5rem;
    }
</style>
