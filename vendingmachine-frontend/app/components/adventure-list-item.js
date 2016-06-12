import Ember from 'ember';

export default Ember.Component.extend({
  tagName: 'tr',

  classNames: ['adventure-list-item'],

  store: Ember.inject.service(),

  isEditing: false,

  actions: {
    enableIsEditing() {
      this.set('isEditing', true);
    },
    disableIsEditing() {
      this.set('isEditing', false);
    },
    save() {
      this.get('store').findRecord('adventure', this.attrs.adventure.value.id).then(function(adventure) {
        console.log(`title: ${adventure.get('title')}`);
        console.log(`desc: ${adventure.get('desc')}`);

        adventure.save();
      });

      this.set('isEditing', false);
    }
  }
});
