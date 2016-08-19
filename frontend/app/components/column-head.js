import Ember from 'ember';

export const orderTypes = {
  none: null,
  forward: 'arrow-down',
  reverse: 'arrow-up'
};

export default Ember.Component.extend({
  tagName: 'th',

  classNames: ['column-head'],

  order: orderTypes.none,

  didUpdate() {
    this._super(...arguments);

    if (this.attrs.currentSort.value !== this.attrs.sortBy) {
      this.set('order', orderTypes.none);
    }
  },

  click() {
    let orderToUse = orderTypes.forward;

    if (this.get('order') === orderTypes.forward) {
      orderToUse = orderTypes.reverse;
    }

    this.set('order', orderToUse);
    this.attrs.sort(this.attrs.sortBy, orderToUse === orderTypes.reverse);
  }
});
