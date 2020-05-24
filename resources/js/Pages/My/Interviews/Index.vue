<template>
  <div class="page-single">
    <div class="container">
      <TechStackFilter :tech-stack="techStack" />
      <InterviewList :interviews="interviews" />
    </div>
  </div>
</template>

<script>

    import Form from 'form-object';
    import collect from 'collect.js'
    import TechStackFilter from '@Components/My/Interviews/TechStackFilter.vue'
    import InterviewList from "@Components/My/Interviews/InterviewList";

    export default {
        components: {TechStackFilter, InterviewList},
        data: function () {
            return {
                form: new Form,
                interviews: collect([])
            }
        },
        computed: {
            techStack() {
                return this
                    .interviews
                    .pluck('candidate.technology_stack')
                    .collapse()
                    .pluck('name', 'id')
                    .all()
            }
        },
        mounted() {
            this.form.post('/api/v1/my/interviews/').then((response) => {
                this.interviews = collect(response)
            })
        }
    }
</script>
