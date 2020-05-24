<template>
  <div class="page-single">
    <div class="container">
      <div class="row">
        <div class="col-lg-4">
          <CandidateCard
            :candidate="candidate"
            :position="position"
            :tags="tags"
          />
          <TechStackFilter :tech-stack="tags" />
        </div>
        <div class="col-lg-8">
          <Question
            v-for="question in filteredTags"
            :key="question.id"
            :question="question"
          />
        </div>
      </div>
    </div>
  </div>
</template>

<script>

import Form from "form-object";
import Question from "@Components/My/Interviews/_Id/Question";
import CandidateCard from "@Components/My/Interviews/_Id/CandidateCard";
import TechStackFilter from "@Components/My/Interviews/_Id/TechStackFilter";
import collect from 'collect.js'
export default {
    components: {Question, CandidateCard, TechStackFilter},
    data: function () {
        return {
            request: new Form,
            candidate: {},
            position: {},
            questions: [],
            answers: [],
            filteredTagsIds: []
        }
    },
    computed: {
        filteredTags () {
            if(this.filteredTagsIds.length) {
                return collect(this.questions)
                    .filter((question) => collect(question.technology_stack).whereIn('id', this.filteredTagsIds).isNotEmpty());
            }

            return this.questions;
        },
        tags () {
            return collect(this.questions).pluck('technology_stack').collapse().unique('id').all()
        }
    },
    mounted() {
        this.$root.$on('techStackToggled', ({ isChecked, id}) => {
            if(isChecked) {
                this.filteredTagsIds.push(id);
            } else {
                this.filteredTagsIds =  this.filteredTagsIds.filter((stackId) => stackId !== id)
            }
        });

        this.request.submit('get', '/api/v1/my/interviews/' + this.$route.params.id).then((response) => {
            ['candidate', 'questions', 'answers', 'position'].forEach((item) => {
                this[item] = response[item];
            });
        })
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
