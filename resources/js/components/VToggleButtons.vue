<template>
  <div class="form-group mb-0">
    <slot></slot>
    <div class="btn-group" role="group" aria-label="Basic example">
      <button
        v-for="(item, index) in items"
        :key="index"
        type="button"
        @click="setOption(item.id)"
        class="btn btn-sm"
        :class="{'btn-primary' : $attrs.value == item.id, 'btn-outline-primary' : $attrs.value != item.id }"
        v-text="item.name"
      ></button>
    </div>
    <hr>
  </div>
</template>

<script>
export default {
  props: {
    items: {
      type: Array,
      default: () => []
    },
    fn: {
      type: Function,
      default: () => null
    }
  },
  methods: {
    setOption(id) {
      this.$emit('input', id);

      if (this.fn !== null) this.fn(id);
    }
  }
};
</script>