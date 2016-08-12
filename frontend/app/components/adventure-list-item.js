import Ember from 'ember';

export default Ember.Component.extend({
  tagName: 'tr',

  classNames: ['adventure-list-item'],

  store: Ember.inject.service(),

  isEditing: false,

  init() {
    this._super(...arguments);

    this.set('adventure.type', this.get('adventure.event_type.label'));
  },

  actions: {
    enableIsEditing() {
      this.set('isEditing', true);
    },
    disableIsEditing() {
      this.set('isEditing', false);
    },
    save() {
      this.get('store').findRecord('adventure', this.attrs.adventure.value.id).then((adventure) => {
        adventure.save();
      });

      this.set('isEditing', false);
    }
  }
});
