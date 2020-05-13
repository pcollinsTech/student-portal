<template>
  <div class="upload-control">
    <!-- <label v-if="label.length > 0" v-text="label"></label> -->

    <div
      class="upload-container"
      :class="{'dragover' : dragOver}"
      @dragover="allowDrop($event)"
      @drop="drop($event)"
      @dragleave="dragOver = false"
    >
      <div
        class="content"
        v-show="(file.data === null || file.data == '') && file.reading === false"
      >
        <div class="info" v-text="label"></div>
        <div class="upload-info" v-text="uploadInfo"></div>
        <input ref="fileUpload" :value="fileInput" type="file" @change="upload($event)" />
      </div>

      <div
        v-show="file.data !== null && file.data != '' && file.reading === false"
        class="contents"
      >
        <div class="file-title" v-text="this.file.name"></div>
        <!-- <img v-if="file.extension != 'mp4'" :src="file.data" />

        <video :src="file.data" v-if="file.extension === 'mp4'" width="100%" height="100%" controls></video>-->

        <div class="controls">
          <button
            v-show="edit"
            @click="reset()"
            type="button"
            class="btn btn-sm btn-primary btn-img-upload"
          >
            <span class="fa fa-trash"></span>
          </button>

          <button
            v-show="edit"
            @click="uploadNew()"
            type="button"
            class="btn btn-sm btn-primary btn-img-upload"
          >
            <span class="fa fa-cloud-upload"></span>
          </button>

          <button @click="download" type="button" class="btn btn-sm btn-primary btn-img-upload">
            <span class="fa fa-download"></span>
          </button>
        </div>
      </div>
      <charger v-show="file.reading" :label="'Uploading '+ file.name"></charger>
    </div>
  </div>
</template>

<script>
import { File } from '../core/File';

export default {
  props: {
    label: {
      type: String,
      default: () => 'Upload File'
    },
    event: {
      type: String,
      default: () => null
    },
    extensions: {
      type: Array,
      default: () => ['jpg', 'png', 'pdf', 'doc', 'docx']
    },
    size: {
      type: Number,
      default: 2
    },
    label: {
      type: String,
      default: true
    },
    dataType: {
      type: String,
      default: true
    },
    edit: {
      type: Boolean,
      default: true
    }
  },
  computed: {
    uploadInfo() {
      return (
        'Ext: ' + this.extensions.join(', ') + ' |  Max: ' + this.size + 'Mb'
      );
    }
  },
  data() {
    return {
      file: new File(null, this.dataType),
      fileInput: null,
      dragOver: false
    };
  },
  methods: {
    uploadNew() {
      this.$refs.fileUpload.click();
    },
    reset() {
      let type = this.file.type;
      this.file = new File(null, this.dataType);
      this.fileInput = null;
      this.dragOver = false;

      Bus.$emit(this.event + '-delete', type);
    },
    upload(event) {
      this.dragOver = false;
      let fileData = event.target.files[0];
      this.file = new File(fileData, this.dataType);
      this.uploadProcess();
    },

    uploadProcess() {
      this.file
        .read(this.extensions, this.size)
        .then(data => {
          this.$emit('input', data);
          if (this.event !== null)
            Bus.$emit(this.event + '-upload', this.file.getAtttributes());
        })
        .catch(error => {
          toastr.error(error);
          this.fileInput = null;
        });
    },

    download() {
      if (this.file.mode !== null) {
        window.open(this.file.mode, '_blank');
      } else {
        var image = new Image();
        image.src = this.file.data;
        var w = window.open('');
        w.document.write(image.outerHTML);
        window.open(this.file.data, '_blank');
      }
    },
    /* Drag And Drop */
    allowDrop(event) {
      if (!this.edit) return;

      this.dragOver = true;
      event.preventDefault();
    },
    drop(event) {
      if (!this.edit) return;

      event.preventDefault();
      let fileData = event.dataTransfer.files[0];
      this.file = new File(fileData, this.dataType);
      this.uploadProcess();
      this.dragOver = false;
    }
  },
  mounted() {
    window.VImageUpload = this;

    if (this.$attrs.value !== null && this.$attrs.value !== undefined) {
      if (this.$attrs.value.substr(0, 200).indexOf('mp4') >= 0)
        this.file.extension = 'mp4';

      this.file.data = this.$attrs.value;
    }

    Bus.$once(this.event + '-set-file-' + this.dataType, file => {
      if (file.type == this.dataType) this.file = file;
    });
  }
};
</script>

<style lang="scss" scoped>
.upload-control {
  position: relative;
  -webkit-touch-callout: none; /* iOS Safari */
  -webkit-user-select: none; /* Safari */
  -khtml-user-select: none; /* Konqueror HTML */
  -moz-user-select: none; /* Old versions of Firefox */
  -ms-user-select: none; /* Internet Explorer/Edge */
  user-select: none;

  .dragover {
    border-color: #282e75 !important;
  }

  label {
    font-weight: 600;
    font-size: 1rem;
  }

  .fas {
    text-align: center;
    color: #eeeeee;
    font-size: 40px;
  }

  .upload-container {
    border: 2px dashed #e1e0e1;
    border-radius: 5px;
    padding: 10px;
    font-size: 12px;
    display: flex;
    position: relative;
    overflow: hidden;
    height: 90px;

    .content {
      cursor: pointer;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      flex: 1;

      input {
        position: absolute;
        height: 100%;
        width: 100%;
        opacity: 0;
        cursor: pointer;
      }
    }

    .contents {
      display: flex;
      flex: 1;
      justify-content: center;
      flex-direction: column;
      align-items: center;
      opacity: 1;

      .controls {
        margin-top: 8px;
      }

      .btn-img-upload {
        opacity: 0.5;
        &:hover {
          opacity: 1;
        }
      }
    }

    img {
      width: 100%;
      height: 100%;
      position: absolute;
    }

    video {
      width: calc(100%);
      position: absolute;
      margin: 0px;
      top: -16px;
      height: calc(100% + 16px);
    }
  }

  .upload-info {
    font-size: 10px;
    color: #282e75;
  }
}
</style>