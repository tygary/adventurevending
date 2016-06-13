import Ember from 'ember';

export default Ember.Component.extend({
  tagName: 'div',
  classNames: ['adventure-list', 'col-md-10', 'col-md-offset-1'],

  store: Ember.inject.service(),

  newAdventure: {},

  currentSort: null,

  init() {
    this._super(...arguments);

    this.set('adventures', this.attrs.adventures.value);
  },

  actions: {
    add() {
      let title = this.get('newAdventure.title');
      let desc = this.get('newAdventure.desc');

      if (!title && !desc) {
        return;
      }

      this.get('store').createRecord('adventure', { title, desc }).save();

      this.set('newAdventure', {});
    },
    remove(id) {
      let store = this.get('store');
      let record = store.peekRecord('adventure', id);
      store.deleteRecord(record);
      record.save();
    },
    sort(property, toReverse) {
      this.set('currentSort', property);

      let sortedAdventures = this.get('adventures').sortBy(property);

      if (toReverse) {
        sortedAdventures = sortedAdventures.reverse();
      }

      this.set('adventures', sortedAdventures);
    }
  }
});
