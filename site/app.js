$(function(){

  var $loader = $('.lds-facebook');
  var $danger = $('.auth-danger');
  var $success = $('.auth-success');

  $('.auth-form').on('submit', function (e) {
    $loader.show();
    var $form = $(e.target);
    var action = $form.attr('action');
    var method = $form.attr('method');

    $.ajax({
      type: method,
      url: action,
      data: {
        login: $('[name=login]', $form).val(),
        password: $('[name=password]', $form).val()
      },
      dataType: 'json',
      complete: function (res) {
        var json = res.responseJSON || {};
        let succeed = json.status === 'success';
        $danger.toggleClass('d-none', succeed);
        $success.toggleClass('d-none', !succeed);

        setTimeout(function () {
          $success.addClass('d-none')
        }, 2000);

        setTimeout(function () {
          $loader.hide();
        }, 200);
      }
    });

    return false;
  });

});
