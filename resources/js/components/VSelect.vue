<template>
  <div class="form-group">
    <label :for="label.toLowerCase()" v-if="label.length >0 ">{{ label }}</label>
    <select
      :disabled="disabled"
      :value="$attrs.value"
      class="form-control form-control-sm"
      @change="updateField($event.target.value)"
    >
      <option :value="item.id" v-for="(item , index) in items" :key="index">{{ item.name }}</option>
    </select>
    <small v-show="error.length > 0" class="form-text text-error">{{ error }}</small>
  </div>
</template>

<script>
export default {
  props: {
    label: {
      type: String,
      default: () => {}
    },
    items: {
      type: Array,
      default: () => []
    },
    error: {
      type: String,
      default: () => ''
    },
    disabled: {
      type: Boolean,
      default: () => false
    }
  },
  methods: {
    updateField(value) {
      this.$emit('input', value);
    }
  }
};
</script>

<style>
</style>