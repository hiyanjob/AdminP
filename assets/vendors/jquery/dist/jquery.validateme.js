;(function ($) {
  $.fn.validateMe = function(options) {
    var $input = this.find('input[required]'),
        $inputEmail = $input.filter('[type=email]'),
        $inputText = $input.filter('[type=text]'),
        $submitBtn = this.find('button'),
        settings = $.extend({
          submitBtn: $submitBtn
        }, options);

    if ( typeof settings.submitBtn == 'string' ) {
      settings.submitBtn = $(settings.submitBtn);
    } else if ( typeof settings.submitBtn == 'object' ) {
      settings.submitBtn.selector = 'button';
    }

    settings.submitBtn.prop('disabled', true);

    $input.on('blur', function () {
      if( validateField.call(this) ) {
        $(this).removeClass('invalid').addClass('valid');
      } else {
        $(this).removeClass('valid').addClass('invalid');
      }

      toggleSubmitBtnState.call(this, settings);
    });

    $input.on('keyup', function () {
      // for better UX it is great to remove invalid state for
      // field when user starts to input information
      $(this).removeClass('invalid');

      if( validateField.call(this) ) {
        $(this).removeClass('invalid').addClass('valid');
      }

      toggleSubmitBtnState.call(this, settings);
    });

    // if occasionally form appear filled when plugin is started,
    // it is useful to validate it immediately
    $input.each(function () {
      if( $(this).val() ) $(this).trigger('blur');
    });
  };

  function validateField(inputVal, type) {
    var result = 1,
        inputVal = $(this).val(),
        type = $(this).attr('type');

    if(type === 'email') {
      result = validateEmail(inputVal);
    } else if (type === 'text') {
      result = validateText(inputVal);
    } else if (type === 'tel') {
      result = validateTel(inputVal);
    }

    return result;
  }

  function toggleSubmitBtnState(settings) {
    var $form = $(this).closest('form');

    if ( isEqualRequiredToValid.call(this) ) {
      $form.find(settings.submitBtn.selector).prop('disabled', false);
    } else {
      $form.find(settings.submitBtn.selector).prop('disabled', true);
    }
  }

  function isEqualRequiredToValid() {
    var validNum = $(this).closest('form').find('.valid').length,
        totalNum = $(this).closest('form').find('[required]').length;

    if (validNum == totalNum) {
      return true;
    } else {
      return false;
    }
  }

  function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
  }

  function validateText(field) {
    if(field) {
      return true;
    } else {
      return false;
    }
  }

  function validateTel(tel) {
    tel = tel.replace(/[^0-9\.]+/g, '');

    if( tel.length >= 9 && tel.length <= 15 ) {
      return true;
    } else {
      return false;
    }
  }
})(jQuery);
