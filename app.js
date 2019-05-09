$(document).ready(function () {
  $('form.ajax').on('submit', function (e) {
    e.preventDefault();
    var $fname = $("#fname");
    var $lname = $("#lname");
    var params = {
      firstname: $fname.val(),
      lastname: $lname.val(),
    }

    $.ajax({
      type: 'POST',
      data: params,
      url: 'save_to_json.php',

      success: function (data) {
        console.log('success');
      },
      error: function (data) {
        console.log('error');
      },
      complete: function () {
        console.log('complete');
      }
    });
    return false;
  });
});