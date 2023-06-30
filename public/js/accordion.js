const accordion = Vue.createApp({
    data() {

    },
}) 

accordion.component('hello-component',{
  template:'<p>Hello</p>'
})

accordion.mount('#accordion');

