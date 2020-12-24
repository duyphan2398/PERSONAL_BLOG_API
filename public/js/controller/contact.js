$(document).ready(function () {
  $('#contactForm').submit(function (e) {
    e.preventDefault()
  }).validate({
    rules: {
      name: {
        required: true,
        maxlength: 255,
      },
      email: {
        required: true,
        email: true,
      },
      phone_number: {
        required: true
      },
      message: {
        required: true,
        maxlength: 10000,
      },
    },
    messages: {
      name: {
        required: 'Name is required',
        maxlength: 'Max length is 255 characters',
      },
      email: {
        required: 'Email is required',
        email: 'Wrong email syntax',
      },
      phone_number: {
        required: 'Phone number is required',
        phone_number: 'Wrong phone number syntax',
      },
      message: {
        required: 'Message is required',
        maxlength: 'Max length is 255 characters',
      },
    },
    submitHandler: function (form) {
      var formData = new FormData(form)
      const config = {
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        },
      }
      $('#sendMessageButton').addClass('btn-loading');

      axios.post(location.origin + '/api/blog/send-mail',
        formData
        , config).then(function (response) {
        $('#contactForm').trigger('reset')
        toastr.success('Send Successfully !')
        $('#sendMessageButton').removeClass('btn-loading');
      }).catch(function (error) {
        toastr.error('Server busy, Please try again !')
        $('#sendMessageButton').removeClass('btn-loading');
      })
    },
  })
})

