(function($){
  $(function(){
    $('.js-lead-form').each(function(){
      const $form = $(this);

      // 1) подстановка utm_* и url (как раньше)
      (function fillUtm(){
        const params = new URLSearchParams(location.search);
        ['source','medium','campaign','content','term'].forEach(k=>{
          const v = params.get('utm_'+k);
          if (v) $form.find(`[name="utm_${k}"]`).val(v);
        });
        $form.find('[name="url"]').val(location.href);
      })();

      // 2) простая валидация
      function validate(){
        let ok = true;
        $form.find('.form-field').removeClass('is-error');
        $form.find('input[required], textarea[required]').each(function(){
          if (!this.checkValidity()){
            ok = false;
            $(this).closest('.form-field').addClass('is-error');
          }
        });
        return ok;
      }
      $form.on('blur input','input,textarea',function(){
        const $fld = $(this).closest('.form-field');
        this.checkValidity() ? $fld.removeClass('is-error') : $fld.addClass('is-error');
      });

      // 3) перехват сабмита
      $form.on('submit', function(e){
        e.preventDefault();
        if (!validate()) return;

        // формируем FormData из всей формы, включая файлы
        const fd = new FormData(this);
        fd.append('action', 'submit_lead');
        fd.append('nonce',  leadFormAjax.nonce);

        const $resp = $form.find('.form-response').removeClass('success error').empty();

        $.ajax({
          url:         leadFormAjax.ajax_url,
          type:        'POST',
          data:        fd,
          processData: false,
          contentType: false,
          dataType:    'json'
        })
        .done(function(res){
          if (res.success){
            if (res.data.redirect){
              return void(location.href = res.data.redirect);
            }
            $resp.addClass('success').text(res.data.message);
            $form[0].reset();
          } else {
            $resp.addClass('error').text(res.data.message || 'Ошибка, попробуйте ещё раз');
          }
        })
        .fail(function(){
          $resp.addClass('error').text('Сбой при отправке, попробуйте позже');
        });
      });
    });
  });
})(jQuery);

