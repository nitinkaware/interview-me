<template>
  <div>
    <div class="row">
      <div
        v-for="interview in interviews"
        :key="interview.id"
        class="col-md-4"
      >
        <CandidateCard
          :candidate="interview.candidate"
          :interview-id="interview.id"
        />
      </div>
    </div>
  </div>
</template>

<script>
    import CandidateCard from "./CandidateCard";
    export default {
        components: {CandidateCard},
        props: {
            interviews: {
                required: true,
                type: Object
            }
        }
    }
</script>
