import Ember from 'ember';

export default Ember.Controller.extend({

  store: Ember.inject.service(),

  newGift: {
    // Defaults
    // title: '',
    // desc: ''
  },

  _addGift() {
    let title = this.get('newGift.title');
    let desc = this.get('newGift.desc');

    if (title === '' || desc === '') {
      return;
    }

    this.store.createRecord('gift', { title, desc }).save();
  },

  actions: {
    add(type) {
      if (type === 'gift') {
        this._addGift();
      }
    },
    remove(type, id) {
      let store = this.get('store');
      let record = store.peekRecord(type, id);
      store.deleteRecord(record);
      record.save();
    }
  }
});
