<template>
  <div class="switch-control">
    <div class="row">
      <div class="col-lg-8">
        <slot></slot>
      </div>
      <div class="col-lg-4 text-right">
        <vradio :disabled="disabled" v-if="$attrs.value !== undefined" v-model="$attrs.value.checked" :fn="updateModel"></vradio>
      </div>
    </div>

    <div
      v-if="$attrs.value !== undefined && $attrs.value.details !== null && $attrs.value.checked === true"
      class="row mt-3"
    >
      <div class="col-lg-6">
        <slot name="extra"></slot>
      </div>
      <div class="col-lg-6">
        <textarea
          type="text"
          @keypress="updateExtra($event.target.value)"
          v-model="details"
          rows="3"
          class="form-control form-control-sm"
        />
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12 text-right">
        <small
          v-show="error !== undefined && error.length > 0"
          class="form-text text-error"
        >{{ error }}</small>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    error: {
      type: String,
      defaut: () => ''
    },
    disabled: {
      type: Boolean,
      default: () => false
    }
  },
  data() {
    return {
      details: ''
    };
  },
  methods: {
    updateExtra(value) {
      let model = Object.assign({}, this.$attrs.value);

      model.details = value;

      this.$emit('input', model);
    },
    updateModel(value) {
      let model = Object.assign({}, this.$attrs.value);

      model.checked = value === 1 ? true : false;

      if (model.checked && model.details !== null) {
        model.details = this.details;
      } else if (model.details !== null) model.details = '';

      this.$emit('input', model);
    }
  },
  mounted() {
    this.details = this.$attrs.value.details;
  }
};
</script>
<style lang="scss" scoped>
.switch-control {
  font-size: 12px;
  text-align: justify;
  margin-top: 1rem;
  margin-bottom: 1rem;
}

small {
  font-size: 11px;
  font-weight: 600;
}
</style>
