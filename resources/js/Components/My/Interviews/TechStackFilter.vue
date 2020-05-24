<template>
  <div class="form-group">
    <label class="form-label">Filter By skills</label>
    <div class="selectgroup selectgroup-pills">
      <CheckBox
        v-for="(name, value) in techStack"
        :id="value"
        :key="value"
        :name="name"
      />
    </div>
  </div>
</template>

<script>
    import CheckBox from "./CheckBox";
    export default {
        components: {CheckBox},
        props: {
            techStack: {
                required: true,
                type: Object
            }
        }
    }
</script>
