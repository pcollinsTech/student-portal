export class File {

  constructor(fileData = null, type = null) {

    this.fileData = fileData;
    this.type = type;
    this.reading = false;
    this.name = null;
    this.extension = null;
    this.data = null;
    this.description = '';
    this.contentType = null;
    this.mode = null;
    if (fileData !== null)
      this.setAttributes(fileData);


  }

  getAtttributes() {

    let fileObj = new Object();

    fileObj.name = this.name;
    fileObj.extension = this.extension;
    fileObj.data = this.data;
    fileObj.contentType = this.contentType;
    fileObj.type = this.type;

    return fileObj;
  }

  setAttributes(fileData) {

    this.name = fileData.name;
    this.extension = this.name.substr(this.name.indexOf('.') + 1).toLowerCase();
    this.contentType = fileData.type;

    if (this.extension === 'jpeg')
      this.extension = 'jpg';


  }

  read(extensions = [], size = 1) {

    let localInstance = this;

    // Get The Correct Size
    let fileSize = this.fileData.size / 1024 / 1024;

    return new Promise((resolve, reject) => {

      /* Before Reading check Extension */
      if (extensions.find(ext => ext == localInstance.extension) === undefined)
        return reject(`Invalid Extension, only ${extensions.join(', ')} are accepted.`)

      /* Before Reading check Size */
      if (fileSize > size)
        return reject(`File too Big, max size is  ${size}Mb are accepted.`)



      let fileReader = new FileReader();

      fileReader.onloadend = function (ev) {

        localInstance.data = fileReader.result;
        localInstance.reading = false;
        resolve(localInstance.data)
      }

      // Start Reading File
      localInstance.reading = true;
      setTimeout(() => {
        fileReader.readAsDataURL(this.fileData);
      }, 1000)


    })


  }

}