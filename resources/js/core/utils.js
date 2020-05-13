export class Utils {

  setHistory(name = '/', pathName = '/') {
    window.history.pushState(null, name, pathName)
    document.title = (document.title + ' ' + name).trim();
    this.scrollToUsername();
  }

  scrollTop(y = 0) {
    window.scrollTo(0, 0)
  }

  scrollToUsername() {

    if (window.scrollY > document.getElementById('welcome').offsetTop)
      window.scrollTo(0, document.getElementById('welcome').offsetTop - 120)
  }


  scrollToHeader() {

    if (window.scrollY > document.getElementById('header-ref').offsetTop)
      window.scrollTo(0, document.getElementById('header-ref').offsetTop - 120)
  }


  unique() {
    return Math.floor(Math.random() * new Date().getUTCMilliseconds() + 1) + this.makeid(5)
  }

  makeid(length) {
    var result = '';
    var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var charactersLength = characters.length;
    for (var i = 0; i < length; i++) {
      result += characters.charAt(Math.floor(Math.random() * charactersLength));
    }
    return result;
  }


  setMedia(endpoint) {

    return axios.get(endpoint)
  }


  getParam(key) {

    let query = window.location.search;
    let paramIndex = query.indexOf(key);

    let paramExtract = query.substr(paramIndex + key.length + 1);

    let indexOfOtherParams = paramExtract.indexOf('&');

    if (indexOfOtherParams >= 0)
      return paramExtract.substr(0, indexOfOtherParams)

    return paramExtract;


  }

}