<template>
  <label class="selectgroup-item">
    <input
      v-model="isChecked"
      type="checkbox"
      name="value"
      class="selectgroup-input"
      @change="onTechStackCheckboxClicked"
    >
    <span
      class="selectgroup-button"
      v-text="name"
    />
  </label>
</template>

<script>
    export default {
        props: {
            name: {
                required: true,
                type: String
            },
            id: {
                required: true,
                type: Number
            },
        },
        data() {
            return {
                isChecked: false
            }
        },
        methods: {
            onTechStackCheckboxClicked() {
                this.$root.$emit('techStackToggled', {
                    isChecked: this.isChecked,
                    id: this.id
                })
            }
        }
    }
</script>
