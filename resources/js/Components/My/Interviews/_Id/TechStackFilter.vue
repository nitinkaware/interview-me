<template>
  <div class="card card-profile">
    <div class="card-body text-center">
      <div class="form-group">
        <label class="form-label">Filter By skills</label>
        <div class="selectgroup selectgroup-pills">
          <CheckBox
            v-for="{name, id} in techStack"
            :id="id"
            :key="id"
            :name="name"
          />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
    import CheckBox from "@Components/My/Interviews/CheckBox";

    export default {
        components: {CheckBox},
        props: {
            techStack: {
                required: true,
                type: Array
            }
        }
    }
</script>
