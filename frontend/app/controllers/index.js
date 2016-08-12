import Ember from 'ember';

export default Ember.Controller.extend({
  queryParams: ['page'],
  page: 0,

  actions: {
    prevPage() {
      if (this.get('page') !== 0) {
        this.decrementProperty('page');
      }
    },
    nextPage() {
      this.incrementProperty('page');
    }
  }
});