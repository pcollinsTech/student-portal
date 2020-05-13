<template>
  <div class="form-group">
    <label v-if="label.length > 0">{{ label }}</label>
    <div
      v-for="(item, index) in itemsData"
      :key="index"
      class="custom-control custom-radio custom-control-inline"
    >
      <input
        :disabled="disabled"
        :checked="item.checked"
        type="radio"
        :id="'check-' + id + index"
        :name="'check-' + id + index"
        class="custom-control-input"
        @click="checkRadio(index)"
      />
      <label class="custom-control-label" :for="'check-' + id + index">{{ item.name }}</label>
    </div>
  </div>
</template>
<script>
export default {
  props: {
    label: {
      type: String,
      default: () => ''
    },
    items: {
      type: Array,
      default: () => [
        { id: 1, name: 'Yes', checked: false },
        { id: 0, name: 'No', checked: false }
      ]
    },
    fn: {
      type: Function,
      default: () => null
    },
    disabled: {
      type: Boolean,
      default: () => false
    }
  },

  data() {
    return {
      id: +new Date(),
      itemsData: this.items
    };
  },
  methods: {
    checkRadio(index) {
      this.itemsData.forEach((checkItem, index) => {
        this.itemsData[index].checked = false;
      });

      this.itemsData[index].checked = true;

      let value = this.itemsData[index].id;

      this.$emit('input', value);

      if (this.fn !== null) this.fn(value);
    }
  },
  mounted() {
    if (this.$attrs.value === true) this.checkRadio(0);

    if (this.$attrs.value === false) this.checkRadio(1);
  }
};
</script>