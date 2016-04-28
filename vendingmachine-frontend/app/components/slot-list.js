import Ember from 'ember';

export default Ember.Component.extend({
  tagName: 'div',
  classNames: ['col-md-6'],

  store: Ember.inject.service(),

  newSlot: {},

  actions: {
    add() {
      let location = Number.parseInt(this.get('newSlot.location'), 10);
      let desc = this.get('newSlot.desc');
      let isEmpty = this.get('newSlot.isEmpty') || false;
      let cost = Number.parseInt(this.get('newSlot.cost'), 10) || 0;

      if (!location) {
        return;
      }

      this.get('store').createRecord('slot', { location, desc, isEmpty, cost }).save();

      this.set('newSlot', {});
    },
    remove(id) {
      let store = this.get('store');
      let record = store.peekRecord('slot', id);
      store.deleteRecord(record);
      record.save();
    }
  }
});
