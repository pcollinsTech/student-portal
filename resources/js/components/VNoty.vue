<template>
  <div class="notys">
    <div v-for="(noty, index) in notys" :key="index" class="noty" :class="noty.type">
      <div class="wrapper">
        <div
          class="fa"
          :class="[{ 'fa-exclamation-triangle': noty.type === 'danger'},{ 'fa-check-circle' :  noty.type === 'success'}, { 'fa-info-circle' :  noty.type === 'info' }, { 'fa-question-circle' :  noty.type === 'confirm' }]"
        ></div>
        <div v-html="noty.msg"></div>
      </div>

      <button class="button btn-close" :class="noty.type" @click="removeNoty()">
        <div class="fa fa-times"></div>
      </button>

      <div class="controls">
        <button
          v-if="noty.event !== null"
          class="button btn-dark is-danger btn-small"
          @click="removeNoty(index)"
        >
          <div class="fa fa-times"></div>
        </button>
        <button
          v-if="noty.event !== null"
          class="button btn-dark btn-small"
          @click="noty.emit(index)"
        >
          <div class="fa fa-check"></div>
        </button>
      </div>
    </div>
  </div>
</template>

<script>
export class Noty {
  constructor(msg = '', type = 'info', event = null, params = null) {
    this.id = utils.unique();

    this.msg = msg;
    this.type = type;
    this.event = event;
    this.params = params;

    if (this.type !== 'confirm') this.hide();
  }

  emit(index) {
   
    Bus.$emit(this.event, this.params);
    Bus.$emit('noty-close', this.id);
  }

  hide() {
    setTimeout(() => {
      Bus.$emit('noty-close', this.id);
    }, 4000);
  }
}

export default {
  data() {
    return {
      notys: []
    };
  },
  methods: {
    removeNoty(index) {
      //  let newIndex = (this.notys.length - 1) - index;

      this.notys.splice(index, 1);
    },

    info(msg, hide = true) {
      this.notys.unshift(new Noty(msg));
      return true;
    },

    error(msg, hide = true) {
      this.notys.unshift(new Noty(msg, 'danger'));
      return true;
    },

    success(msg, hide = true) {
      this.notys.unshift(new Noty(msg, 'success'));
      return true;
    },

    confirm(msg, event, params = null, type = 'confirm') {
      this.notys.unshift(new Noty(msg, type, event, params));
      return true;
    }
  },
  mounted() {
    window.toastr = this;

    Bus.$on('noty-close', id => {
      for (var i = 0; i < this.notys.length; i++) {
        if (this.notys[i].id === id) {
          this.notys.splice(i, 1);
          break;
        }
      }
    });
  }
};
</script>

<style lang="scss" scoped>
.btn-close {
  position: absolute;
  top: -3px;
  right: -3px;
  padding: 0px 0px !important;
  font-size: 10px;
  line-height: 0px;
  border-radius: 100%;
  background-color: transparent;
  color: #23201f;
  height: 18px;
  width: 17px;
  border: none;
  &:hover {
    color: white;
  }
}

.controls {
  margin-top: 10px;
  text-align: right;

  button {
    display: inline-block;
  }
}
.notys {
  position: fixed;
  right: 20px;
  top: 20px;
  z-index: 3000;
  width: 280px;
}

.noty {
  color: #23201f !important;
  padding: 12px !important;
  padding: 1rem 1.2rem 0.7rem 0rem !important;
  border-radius: 4px;
  font-size: 14px;
  margin-bottom: 7px;
  position: relative;
  box-shadow: 1px 4px 5px -1px rgba(0, 0, 0, 0.3);

  .wrapper {
    display: flex;
    flex-direction: row;
    flex: 1;
    align-content: left;
    position: relative;
    width: 100%;
    text-align: left;
    justify-content: flex-start;

    .fa {
      padding: 4px 21px 0px;
      font-size: 20px;
    }
  }
}

.info {
  background-color: #ee4097 !important;
}

.confirm {
  background-color: #343a40 !important;
}

.danger {
  background-color: #ee4097 !important;
}

.success {
  background-color: #0071ba !important;
}
</style>