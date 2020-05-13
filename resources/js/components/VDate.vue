<template>
  <div ref="datepicker" class="form-group">
    <label :for="label.toLowerCase()" v-if="label.length > 0">{{ label }}</label>
    <vc-date-picker
      v-if="disabled == false"
      v-model="model"
      :popover="{ placement: 'bottom', visibility: 'click' }"
      :input-props="customProps"
      :is-required="true"
      :masks="{ input: ['DD/MM/YYYY'] }"
      @input="inputEvent"
    />
    <input v-else :disabled="disabled" class="form-control form-control-sm" type="text" :value="modelDate" />
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
    error: {
      type: String,
      default: () => ''
    },
    container: {
      type: String,
      default: () => ''
    },
    disabled: {
      type: Boolean,
      default: () => false
    }
  },
  computed:{

    modelDate(){

      return moment(this.$attrs.value).format('MM/DD/YYYY')
    }
  },
  data() {
    return {
      model: null,
      customProps: {
        class: 'form-control form-control-sm',
        placeholder: 'Enter a Date'
      }
    };
  },
  methods: {
    inputEvent: function(date) {
      this.$emit('input', date);
    }
  },
  mounted() {
    let local = this;
   
    this.model = new Date(this.$attrs.value);
  }
};
</script>
