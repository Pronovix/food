/**
 * @file
 * Script extensions for the Card component.
 */

Drupal.behaviors.zgCards = {
  attach: function attach() {
    const cards = document.getElementsByClassName('card');

    for (let i = 0; i < cards.length; i++) {
      if (cards[i].getElementsByTagName('a').length > 0) {
        cards[i].classList.add('card--interactive');
      }
    }
  },
};
