import Ember from 'ember';

export default Ember.Component.extend({
  classNames: ['bootstrap-dropdown dropdown'],

  showDropdown: false,

  actions: {
    toggleDropdown() {
      this.toggleProperty('showDropdown');
    }
  }
});
