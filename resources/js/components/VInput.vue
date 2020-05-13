<template>
  <div class="form-group">
    <label :for="label.toLowerCase()" v-if="label.length > 0">{{ label }}</label>
    <input
      :disabled="disabled"
      :type="dataType"
      class="form-control form-control-sm"
      :class="{'disabled' : disabled }"
      :value="$attrs.value"
      @keypress="updateField($event.target.value)"
      @change="updateField($event.target.value)"
      :placeholder="placeholder"
      autocomplete="off"
    />
    <small v-show="error.length > 0" class="form-text text-error">{{ error }}</small>
  </div>
</template>

<script>
export default {
  props: {
    label: {
      type: String,
      default: () => ''
    },
    dataType: {
      type: String,
      default: () => 'text'
    },
    disabled: {
      type: Boolean,
      default: () => false
    },
    error: {
      type: String,
      default: () => ''
    },
    placeholder: {
      type: String,
      default: () => ''
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