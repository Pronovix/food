/**
 * @file
 * Set the is-active class on <a>
 *   menu elements that trigger redirect in Drupal - they don't work
 *   with core/misc/ąctive-link.js
 */

/**
 * Set 'is-active' class on a menu account link manually if needed
 *
 * @type {Drupal~behavior}
 *
 * @prop {Drupal~behaviorAttach} attach
 *   Attaches in_page_navigation behaviors.
 */

Drupal.behaviors.zgActiveLinks = {
  attach: () => {
    const activeMenu = document.getElementById('navigation').querySelectorAll('a.is-active');
    if (activeMenu.length > 0) {
      return;
    }
    const menuAccount = document.querySelector('.menu--account');
    if (!menuAccount) {
      return;



    }

    const urlsToCheck = [
      {
        regex: /^\/user\/\d+\/apps$/g,
        href: '/user/apps',
      },
      {
        regex: /^\/user\/\d+$/g,
        href: '/user',
      },
    ];

    const linkToActivate = urlsToCheck.filter((e) => {
      return e.regex.test(window.location.pathname);
    })[0];
    if (linkToActivate) {
      menuAccount.querySelector(`a[href="${linkToActivate.href}"]`).classList.add('is-active');
    }
  },
};
