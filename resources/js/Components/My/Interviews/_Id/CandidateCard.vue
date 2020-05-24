<template>
  <div class="card card-profile">
    <div class="card-body text-center">
      <h3
        class="mb-3"
        v-text="candidate.name"
      />
      <p
        class="mb-4"
        v-text="position.name"
      />
      <span
        v-for="{name, id} in tags"
        :key="id"
        class="tag mr-2"
        v-text="name"
      />
      <div class="mt-5">
        <button class="btn btn-primary btn-md">
          <span class="fa fa-twitter" /> Complete Interview
        </button>
      </div>
    </div>
  </div>
</template>

<script>
    export default {
        props: {
            candidate: {
                required: true,
                type: Object
            },
            position: {
                required: true,
                type: Object
            },
            tags: {
                required: true,
                type: Array
            },
        }
    }
</script>
