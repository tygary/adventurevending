import Ember from 'ember';

export default Ember.Component.extend({
  tagName: 'div',
  classNames: ['col-md-6'],

  store: Ember.inject.service(),

  newGift: {},

  actions: {
    add() {
      let title = this.get('newGift.title');
      let desc = this.get('newGift.desc');

      if (!title && !desc) {
        return;
      }

      this.get('store').createRecord('gift', { title, desc }).save();

      this.set('newGift', {});
    },
    remove(id) {
      let store = this.get('store');
      let record = store.peekRecord('gift', id);
      store.deleteRecord(record);
      record.save();
    }
  }
});
