
const app = Vue.createApp({
  data() {
    return {
      show: "1",
      check: false,
      modal: false,
      newLog: false,
    };
  },
  methods: {
    select: function (num) {
      this.show = num;
    },
    modalOpen: function() {
      this.modal = true;
    },
    modalClose: function() {
      this.modal = !this.modal;
    },
    newLogCreate: function() {
      this.newLog = !this.newLog;
    }
    
  },
})
app.mount("#app");

//アコーディオンメニュー
// $(function() {
//   $('.open').click(function() {
//     $(this).toggleClass('active');
//     $(this).next('.open-form').slideToggle();
//   })
// })

$(function() {
  $('.training_check').change(function() {
    var checkboxId = $(this).attr('id');
    var textFormId = '#text_form' + checkboxId.substring(5);
    var textForm = $(textFormId);

    if(this.checked){
      textForm.addClass('open');
    } else {
      textForm.removeClass('open');
    }
    
    // $(textFormId).toggleClass('open');
  })
})

let url = window.location;
$('nav a[href="'+url+'"]').addClass('current');


