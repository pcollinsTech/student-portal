
export class Form {

  constructor(endpoint, model) {

    this.endpoint = endpoint;
    this.model = model;
    this.errors = {};

    this.setFields()
  }

  setFields() {

    Object.keys(this.model).forEach(key => {

      this[key] = this.model[key]
    })
  }


  getFields() {

    let model = {};

    Object.keys(this.model).forEach(key => {

      model[key] = this[key]
    })

    return model;

  }

  clearErrors() {

    this.errors = {};
  }

  submit() {

    return new Promise((resolve, reject) => {

      axios.post(this.endpoint, this.getFields()).then(response => {

        let payload = response.data;

        resolve(payload)

      }).catch(ex => {


        if (ex.response.status === 422) {
          this.errors = ex.response.data.errors
          toastr.info('Please Check the Form')
        }

        reject(ex);

      })
    })
  }

  getError(key) {

    if (this.errors[key] !== undefined)
      return this.errors[key][0].replace('.checked', '')
    return '';
  }

  hasError(key) {
    return (this.errors[key] !== undefined)
  }


  getErrorFromMessage(key, find, message) {

    let error = this.errors[key];

    if (error == undefined)
      return '';

    
    if (error[0].indexOf(find) >= 0)
      return message

    return '';
  }
}