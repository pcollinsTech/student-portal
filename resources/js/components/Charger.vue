<template>
  <div :class="{'loading' : loading }" class="charger loading">
    <div class="text" v-text="label"></div>
  </div>
</template>

<script>
export default {
  props: {
    loading: {
      type: Boolean,
      default: () => false
    },
    label: {
      type: String,
      default: () => 'Uploading File'
    }
  }
};
</script>

<style lang="scss" scoped>
.text {
  position: absolute;
  width: 100%;
  text-align: center;
  z-index: 200;
  top: calc(50% - 14px);
  font-size: 14px;
  color: inherit;
}
</style>