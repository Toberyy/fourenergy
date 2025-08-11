/* main.js — Modular site scripts
   Each module/functionality is separated and documented in English.
*/

// ========== MENU TOGGLE MODULE ==========
(function() {
  document.addEventListener('DOMContentLoaded', function() {
    const burger = document.querySelector('.menu__burger');
    const menu = document.querySelector('.main-navigation');
    const body = document.body;
    const closeBtn = document.querySelector('.close');

    function openMenu() {
      menu.classList.add('is-active');
      burger.classList.add('is-open');
      body.classList.add('open-menu');
    }

    function closeMenu() {
      menu.classList.remove('is-active');
      burger.classList.remove('is-open');
      body.classList.remove('open-menu');
    }

    if (burger && menu) {
      burger.addEventListener('click', openMenu);
    }

    if (closeBtn && menu) {
      closeBtn.addEventListener('click', closeMenu);
    }

    // Close menu on anchor link click
    document.querySelectorAll('.main-navigation a[href^="#"]').forEach(link => {
      link.addEventListener('click', closeMenu);
    });
  });
})();


// ========== HEADER SCROLL STICKY MODULE ==========
(function() {
  document.addEventListener('DOMContentLoaded', function() {
    const header = document.querySelector('.site-header');
    const body = document.body;

    function onScroll() {
      if (window.scrollY > 150) {
        header.classList.add('is-scrolled');
        if (body.classList.contains('admin-bar')) {
          header.classList.add('is-scrolled-admin');
        } else {
          header.classList.remove('is-scrolled-admin');
        }
      } else {
        header.classList.remove('is-scrolled', 'is-scrolled-admin');
      }
    }

    window.addEventListener('scroll', onScroll);
    onScroll();
  });
})();


// ========== NAV LINKS HOVER DROPDOWN MODULE ==========
(function() {
  document.addEventListener('DOMContentLoaded', function() {
    const btn = document.querySelector('.menu__links_button');
    const list = document.querySelector('.menu__links_list');
    let hideTimer;

    if (!btn || !list) return;

    function showList() {
      clearTimeout(hideTimer);
      list.classList.add('visible');
    }

    function hideList() {
      hideTimer = setTimeout(() => {
        list.classList.remove('visible');
      }, 400);
    }

    btn.addEventListener('mouseenter', showList);
    list.addEventListener('mouseenter', showList);
    btn.addEventListener('mouseleave', hideList);
    list.addEventListener('mouseleave', hideList);
  });
})();


// ========== SCROLL-DOWN BUTTON MODULE ==========
(function($) {
  $(function() {
    const $btn = $('.scroll-down');
    const threshold = 500;

    $btn.hide();

    $(window).on('scroll', function() {
      if ($(this).scrollTop() > threshold) {
        $btn.fadeIn(200);
      } else {
        $btn.fadeOut(200);
      }
    });

    $btn.on('click', function(e) {
      e.preventDefault();
      $('html, body').animate({ scrollTop: 0 }, 600);
    });
  });
})(jQuery);


// ========== COOKIE BANNER MODULE ==========
(function() {
  document.addEventListener('DOMContentLoaded', function() {
    const banner = document.querySelector('.cookie');
    if (!banner) return;

    function getCookie(name) {
      const match = document.cookie.match(new RegExp('(?:^|; )' + name + '=([^;]*)'));
      return match ? decodeURIComponent(match[1]) : null;
    }

    function setCookie(name, value, days) {
      const date = new Date();
      date.setTime(date.getTime() + days * 24*60*60*1000);
      document.cookie = `${name}=${encodeURIComponent(value)};expires=${date.toUTCString()};path=/`;
    }

    if (getCookie('cookieAccepted') === 'true') return;

    banner.style.display = '';
    banner.querySelector('.cookie__btn').addEventListener('click', function() {
      setCookie('cookieAccepted', 'true', 7);
      banner.style.transition = 'opacity .3s';
      banner.style.opacity = '0';
      setTimeout(() => banner.remove(), 300);
    });
  });
})();


// ========== MODAL DIALOG MODULE ==========
(function($) {
  $(function() {
    const $triggers = $('.modal-open');
    const $modal = $('.form-modal');
    const $overlay = $modal.find('.form-modal__overlay');
    const $close = $modal.find('.form-modal__close');
    const $body = $('body');

    if (!$triggers.length || !$modal.length) return;

    $triggers.on('click', function(e) {
      e.preventDefault();
      $modal.css({ display: 'flex', opacity: 0 }).animate({ opacity: 1 }, 200);
      $body.css('overflow','hidden');
    });

    $overlay.add($close).on('click', function() {
      $modal.animate({ opacity: 0 }, 200, function() {
        $modal.css('display', 'none');
      });
      $body.css('overflow','auto');
    });
  });
})(jQuery);


// ========== RESPONSIVE PLACEMENT MODULE ==========
(function() {
  document.addEventListener('DOMContentLoaded', function() {
    // Ищем контейнер навигации
    const navWrap = document.querySelector('.header-menu-wrap');
    if (!navWrap) return;

    // Создаем (или находим) внутренний блок для ссылок
    let linksContainer = navWrap.querySelector('.header-menu-wrap-links');
    if (!linksContainer) {
      linksContainer = document.createElement('div');
      linksContainer.className = 'header-menu-wrap-links';
      navWrap.appendChild(linksContainer);
    }

    // Список элементов и их порогов
    const config = [
      { selector: '.mail',     breakpoint: 1024 },
      { selector: '.telegram', breakpoint: 1024 },
      { selector: '.whatsapp', breakpoint: 1024 },
      { selector: '.telefon',  breakpoint:  768 }
    ];

    // Собираем информацию об элементах
    const items = config.map(({ selector, breakpoint }) => {
      const el = document.querySelector(selector);
      if (!el) return null;
      return {
        el,
        originalParent: el.parentNode,
        nextSibling:    el.nextSibling,
        breakpoint
      };
    }).filter(Boolean);

    // Функция переноса / возврата
    function updatePlacement() {
      const w = window.innerWidth;
      items.forEach(item => {
        if (w < item.breakpoint) {
          // на узком экране — в .header-menu-wrap-links
          if (!linksContainer.contains(item.el)) {
            linksContainer.appendChild(item.el);
          }
        } else {
          // на широком — возвращаем назад
          if (!item.originalParent.contains(item.el)) {
            item.originalParent.insertBefore(item.el, item.nextSibling);
          }
        }
      });
    }

    // Инициализация и обновление при ресайзе (с debounce)
    updatePlacement();
    let resizeTO;
    window.addEventListener('resize', function() {
      clearTimeout(resizeTO);
      resizeTO = setTimeout(updatePlacement, 100);
    });
  });
})();





// ========== PHONE INPUT MASK MODULE ==========
(function() {
  document.addEventListener('DOMContentLoaded', function() {
    // Селектор под ваш input: #modal-phone или .modal-phone
    const phoneInputs = document.querySelectorAll('.modal-phone');

    function maskPhone(e) {
      let digits = e.target.value.replace(/\D/g, '');
      if (digits.charAt(0) === '8')      digits = '7' + digits.slice(1);
      if (digits.charAt(0) !== '7')      digits = '7' + digits;
      digits = digits.slice(0, 11);

      let formatted = '+7';
      if (digits.length > 1)  formatted += ' (' + digits.slice(1,4) + ')';
      if (digits.length > 4)  formatted += ' '   + digits.slice(4,7);
      if (digits.length > 7)  formatted += '-'   + digits.slice(7,9);
      if (digits.length > 9)  formatted += '-'   + digits.slice(9,11);

      e.target.value = formatted;
    }

    if (phoneInputs.length) {
      phoneInputs.forEach(function(input) {
        input.addEventListener('input', maskPhone);
        input.addEventListener('blur',  maskPhone);
      });
    }
  });
})();



// ========== SMOOTH SCROLL MODULE ==========
(function() {
  function ease(t, b, c, d) {
    t /= d/2;
    return t < 1 ? c/2*t*t + b : -c/2*((--t)*(t-2)-1) + b;
  }

  function smoothScroll(targetId) {
    const targetEl = document.getElementById(targetId);
    if (!targetEl) return;
    const start = window.pageYOffset;
    const offset = window.innerWidth <= 767 ? 100 : 200;
    const end = targetEl.offsetTop - offset;
    const distance = end - start;
    const duration = 1000;
    let startTime = null;

    function animation(current) {
      if (!startTime) startTime = current;
      const timeElapsed = current - startTime;
      const run = ease(timeElapsed, start, distance, duration);
      window.scrollTo(0, run);
      if (timeElapsed < duration) requestAnimationFrame(animation);
    }
    requestAnimationFrame(animation);
  }

  document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('a[href^="#"]').forEach(link => {
      link.addEventListener('click', function(e) {
        const id = this.getAttribute('href').slice(1);
        if (document.getElementById(id)) {
          e.preventDefault();
          smoothScroll(id);
        }
      });
    });
  });
})();


// ========== TEL LINK NORMALIZER MODULE ==========
(function() {
  document.addEventListener('DOMContentLoaded', function() {
    // Берём только ссылки-телефоны (можно сузить селектором '.telefon')
    document.querySelectorAll('a[href^="tel:"], a.telefon').forEach(function(link) {
      // Берём либо текст, либо уже указанный href
      var source = link.getAttribute('href').startsWith('tel:')
        ? link.getAttribute('href')
        : link.textContent;

      var raw = (source || '').replace(/\D+/g, '');
      if (!raw) return;

      // Нормализация под RU
      if (raw.length === 11 && raw[0] === '8') raw = '7' + raw.slice(1);
      if (raw.length === 10) raw = '7' + raw;

      link.setAttribute('href', 'tel:+' + raw);
    });
  });
})();


// ========== FILE UPLOAD MODULE ==========
(function($) {
  $(function() {
    function humanFileSize(size) {
      if (size === 0) return '0 b';
      const i = Math.floor(Math.log(size) / Math.log(1024));
      const num = size / Math.pow(1024, i);
      const round = Math.round(num * 10) / 10;
      const units = ['b','kb','mb','gb','tb'];
      return round + ' ' + units[i];
    }

    $('[data-upload-block]').each(function() {
      const $block = $(this);
      const $input = $block.find('.file-upload-input');
      const $placeholder = $block.find('.file-upload-placeholder');
      const $preview = $block.find('.file-upload-preview');
      const $fileNameEl = $block.find('[data-file-name]');
      const $fileMetaEl = $block.find('[data-file-meta]');
      const $removeBtn = $block.find('[data-remove-file]');

      $input.on('change', function() {
        const file = this.files[0];
        if (!file) return;
        const ext = file.name.split('.').pop().toLowerCase();
        let typeLabel = 'File';
        if (ext === 'pdf') typeLabel = 'PDF File';
        else if (/docx?/i.test(ext)) typeLabel = 'DOC File';

        $fileNameEl.text(file.name);
        $fileMetaEl.text(typeLabel + ' — ' + humanFileSize(file.size));
        $placeholder.hide();
        $preview.prop('hidden', false);
      });

      $removeBtn.on('click', function() {
        $input.val(null);
        $preview.prop('hidden', true);
        $placeholder.show();
      });
    });
  });
})(jQuery);


// ========== FORM FIELD VALUE TOGGLE MODULE ==========
(function($) {
  $(function() {
    $('.form-field').each(function() {
      const $wrapper = $(this);
      const $input = $wrapper.find('input, textarea, select');

      function updateClass() {
        if ($input.val().trim()) {
          $wrapper.addClass('has-value');
        } else {
          $wrapper.removeClass('has-value');
        }
      }

      updateClass();
      $input.on('input change', updateClass);
    });
  });
})(jQuery);


// ========== FAQ ACCORDION MODULE ==========
(function($) {
  $(function() {
    $('.faq__content-answer').hide();
    $(document).off('click.faqToggle').on('click.faqToggle', '.faq__content-item', function(e) {
      e.preventDefault();
      const $item = $(this);
      const $answer = $item.find('.faq__content-answer');

      $('.faq__content-item').not($item).removeClass('open')
        .find('.faq__content-answer').slideUp(200);

      $answer.stop(true,true).slideToggle(200);
      $item.toggleClass('open');
    });
  });
})(jQuery);


// ========== SWIPER SLIDER MODULE ==========
(function($) {
  $(function() {
    if (typeof Swiper === 'undefined') {
      console.warn('Swiper is not available');
      return;
    }

    $('.swiper-container').each(function() {
      const $container = $(this);
      if ($container.data('swiperInitialized')) return;

      new Swiper(this, {
        loop: false,
        preloadImages: false,
        lazy: {
          loadPrevNext: true,
          loadOnTransitionStart: true
        },
        navigation: {
          nextEl: $container.find('.swiper-button-next')[0],
          prevEl: $container.find('.swiper-button-prev')[0]
        },
       
        a11y: {
          enabled: true,
          prevSlideMessage: 'Previous slide',
          nextSlideMessage: 'Next slide',
          paginationBulletMessage: 'Go to slide {{index}}'
        },
        spaceBetween: 10,
        breakpoints: {
          322: { slidesPerView: 2 },
          768: { slidesPerView: 3 },
          1024: { slidesPerView: 4 }
        },
        on: {
          init: function() {
            $container.attr('aria-label', 'Slider');
          }
        }
      });

      $container.data('swiperInitialized', true);
    });
  });
})(jQuery);


// ========== CONTRACTOR INTERACTION SLIDER MODULE ==========
(function($) {
  $(function() {
    if (typeof Swiper === 'undefined') {
      console.warn('Swiper is not available for contractor interaction slider');
      return;
    }
    $('.contractor-interaction__slider.swiper-container').each(function() {
      const $container = $(this);
      if ($container.data('swiperInitializedContractor')) return;
      new Swiper(this, {
        loop: false,
        spaceBetween: 10,
        preloadImages: false,
        lazy: {
          loadPrevNext: true,
          loadOnTransitionStart: true
        },
        navigation: {
          nextEl: $container.find('.swiper-button-next')[0],
          prevEl: $container.find('.swiper-button-prev')[0]
        },
       
        a11y: true,
        breakpoints: {
          320: { slidesPerView: 1 },
          599: { slidesPerView: 2 },
          1000: { slidesPerView: 3 },
          1440: { slidesPerView: 3.5 }
        }
      });
      $container.data('swiperInitializedContractor', true);
    });
  });
})(jQuery);

(function($) {
  $(function() {
    if (typeof Swiper === 'undefined') {
      console.warn('Swiper is not available for reviews slider');
      return;
    }

    $('.reviews__slider.swiper-container').each(function() {
      const $container = $(this);
      if ($container.data('swiperInitializedReviews')) return;

      new Swiper(this, {
        loop: false,
        preloadImages: false,
        lazy: {
          loadPrevNext: true,
          loadOnTransitionStart: true
        },
        navigation: {
          nextEl: $container.find('.swiper-button-next')[0],
          prevEl: $container.find('.swiper-button-prev')[0]
        },
        pagination: {
          el: $container.find('.swiper-pagination')[0],
          clickable: true
        },
        a11y: {
          enabled: true,
          prevSlideMessage: 'Previous review',
          nextSlideMessage: 'Next review',
          paginationBulletMessage: 'Go to review {{index}}'
        },
        spaceBetween: 10,
        breakpoints: {
          640: { slidesPerView: 1, spaceBetween: 10 },
          768: { slidesPerView: 2, spaceBetween: 10 },
          1024: { slidesPerView: 2, spaceBetween: 10 }
        },
        on: {
          init: function() {
            $container.attr('aria-label', 'Reviews slider');
          }
        }
      });

      $container.data('swiperInitializedReviews', true);
    });
  });



})(jQuery);

// ========== COMMISSIONING CHECKLIST LIST TOGGLE INSIDE UL (fixed) ==========
(function($){
  $(function(){
    const maxVisible = 4;

    $('.commissioning-checklist__list').each(function(){
      const $ul           = $(this);
      // уже инициализировали — пропускаем
      if ( $ul.data('toggle-init') ) return;
      $ul.data('toggle-init', true);

      // сразу же вытаскиваем только оригинальные <li>, без контроля
      const $originalLis  = $ul.children('li').not('.js-toggle-control');
      const totalItems    = $originalLis.length;
      if ( totalItems <= maxVisible ) return;

      // скрываем все после 4-го
      const $hiddenLis    = $originalLis.slice(maxVisible).hide().addClass('js-hidden-item');
      const hiddenCount   = $hiddenLis.length;

      // создаём единственный <li>–контрол
      const $toggleLi = $(
        `<li class="commissioning-checklist__toggle js-toggle-control">
           <p style="cursor:pointer;">Ещё +${hiddenCount} пунктов</p>
         </li>`
      );
      // вставляем в конец списка
      $ul.append( $toggleLi );

      let isOpen = false;
      $toggleLi.on('click', 'p', function(){
        if ( !isOpen ) {
          $hiddenLis.slideDown(200);
          $(this).text('Скрыть');
        } else {
          $hiddenLis.slideUp(200);
          $(this).text(`Ещё +${hiddenCount} пунктов`);
        }
        isOpen = !isOpen;
      });
    });
  });
})(jQuery);


// ========== TEAM SLIDER MODULE ==========
(function($) {
  $(function() {
    if (typeof Swiper === 'undefined') {
      console.warn('Swiper is not available for team slider');
      return;
    }

    $('.team__content_slider').each(function() {
      const $container = $(this);
      if ($container.data('swiperInitializedTeam')) return;

      new Swiper(this, {
        navigation: {
          nextEl: $container.find('.swiper-button-next')[0],
          prevEl: $container.find('.swiper-button-prev')[0]
        },
        spaceBetween: 10,
        slidesPerView: 2,
        breakpoints: {
         320:  { slidesPerView: 1 },
          768:  { slidesPerView: 2 }
        },
        on: {
          init: function() {
            $container.attr('aria-label', 'Team slider');
          }
        }
      });

      $container.data('swiperInitializedTeam', true);
    });
  });
})(jQuery);


// ========== OWN EQUIPMENT SLIDER MODULE ==========
(function($) {
  $(function() {
    if (typeof Swiper === 'undefined') {
      console.warn('Swiper is not available for own equipment slider');
      return;
    }

    $('.own-equipment-slider.swiper-container').each(function() {
      const $container = $(this);
      if ($container.data('swiperInitializedOwnEquipment')) return;

      new Swiper(this, {
        loop: false,
        spaceBetween: 10,
        preloadImages: false,
        lazy: {
          loadPrevNext: true,
          loadOnTransitionStart: true
        },
        navigation: {
          nextEl: $container.find('.swiper-button-next')[0],
          prevEl: $container.find('.swiper-button-prev')[0]
        },
        breakpoints: {
          640:  { slidesPerView: 2 },
          1000:  { slidesPerView: 3 },
          1440: { slidesPerView: 4 }
        },
        on: {
          init: function() {
            $container.attr('aria-label', 'Own equipment slider');
          }
        }
      });

      $container.data('swiperInitializedOwnEquipment', true);
    });
  });
})(jQuery);


// ========== WAREHOUSE SLIDER MODULE ==========
(function($) {
  $(function() {
    if (typeof Swiper === 'undefined') {
      console.warn('Swiper is not available for warehouse slider');
      return;
    }

    $('.warehouse__slider.swiper-container').each(function() {
      const $container = $(this);
      if ($container.data('swiperInitializedWarehouse')) return;

      new Swiper(this, {
        loop: false,
        preloadImages: false,
        lazy: {
          loadPrevNext: true,
          loadOnTransitionStart: true
        },
        navigation: {
          nextEl: $container.find('.swiper-button-next')[0],
          prevEl: $container.find('.swiper-button-prev')[0]
        },
        spaceBetween: 20,
        slidesPerView: 1,
        breakpoints: {
          640:  { slidesPerView: 1 },
          768:  { slidesPerView: 1 },
          1024: { slidesPerView: 1 }
        },
        on: {
          init: function() {
            $container.attr('aria-label', 'Warehouse slider');
          }
        }
      });

      $container.data('swiperInitializedWarehouse', true);
    });
  });
})(jQuery);


// ========== CUSTOM PROJECT MODAL ==========
(function() {
  document.addEventListener('DOMContentLoaded', function() {
    // Open modal on project button click
    document.querySelectorAll('.preview-project .btn-project').forEach(function(btn) {
      btn.addEventListener('click', function(e) {
        e.preventDefault();
        const preview = btn.closest('.preview-project');
        if (!preview) return;
        showProjectModal(preview);
      });
    });

    function showProjectModal(preview) {
      // Remove existing modal if any
      const existing = document.querySelector('.project-modal-container');
      if (existing) existing.remove();

      // Extract data from preview
      const titleText = preview.querySelector('.title')?.innerText || '';
      const subtitleText = preview.querySelector('.preview-project__subtitle')?.innerText || '';
      const metaItems = Array.from(preview.querySelectorAll('.preview-project__meta-item')).map(item => {
        return {
          label: item.querySelector('.meta-label')?.innerText || '',
          value: item.querySelector('.meta-value')?.innerText || ''
        };
      });
      const sections = Array.from(preview.querySelectorAll('.preview-project__body-block')).map(block => {
        return {
          title: block.querySelector('.block-title')?.innerText || '',
          html: block.querySelector('.preview-project__body-text')?.innerHTML || ''
        };
      });

      // Build modal HTML
      const container = document.createElement('div');
      container.className = 'project-modal-container';

      const overlay = document.createElement('div');
      overlay.className = 'form-modal__overlay';
      container.appendChild(overlay);

      const modal = document.createElement('div');
      modal.className = 'form-modal__inner';
      container.appendChild(modal);

      const closeBtn = document.createElement('button');
      closeBtn.className = 'form-modal__close';
      modal.appendChild(closeBtn);

      // Header
      const header = document.createElement('div');
      header.className = 'project-modal-header';
      const div = document.createElement('div');
      div.className = 'project-modal-top';
      div.innerText = 'О проекте';
      header.appendChild(div);
      if (subtitleText) {
        const p = document.createElement('p');
        p.className = 'project-modal-subtitle';
        p.innerText = subtitleText;
        header.appendChild(p);
      }
      modal.appendChild(header);

      // Meta
      if (metaItems.length) {
        const metaWrap = document.createElement('div');
        metaWrap.className = 'project-modal-meta';
        metaItems.forEach(mi => {
          const item = document.createElement('div');
          item.className = 'project-modal-meta-item';
          const lbl = document.createElement('span');
          lbl.className = 'project-modal-meta-label';
          lbl.innerText = mi.label;
          const val = document.createElement('span');
          val.className = 'project-modal-meta-value';
          val.innerText = mi.value;
          item.appendChild(lbl);
          item.appendChild(val);
          metaWrap.appendChild(item);
        });
        modal.appendChild(metaWrap);
      }

      // Body sections
      const body = document.createElement('div');
      body.className = 'project-modal-body';
      sections.forEach(sec => {
        const secEl = document.createElement('div');
        secEl.className = 'project-modal-section';


        if (sec.title) {
          const h3 = document.createElement('span');
          h3.className = 'project-modal-section-title';
          h3.textContent = sec.title;
          secEl.appendChild(h3);
        }
        if (sec.html) {
          const div = document.createElement('div');
          div.className = 'project-modal-section-text';
          div.innerHTML = sec.html;
          secEl.appendChild(div);
        }
        body.appendChild(secEl);
      });
      modal.appendChild(body);

      // Append to document
      document.body.appendChild(container);
      document.body.classList.add('project-modal-open');

      // Close handlers
      closeBtn.addEventListener('click', closeProjectModal);
      overlay.addEventListener('click', closeProjectModal);
    }

    function closeProjectModal() {
      const container = document.querySelector('.project-modal-container');
      if (container) container.remove();
      document.body.classList.remove('project-modal-open');
    }
  });
})();


Fancybox.bind("[data-fancybox]", {
  loop: true,
  animated: true,
  showClass: "fancybox-zoomIn",
  hideClass: "fancybox-zoomOut",
});