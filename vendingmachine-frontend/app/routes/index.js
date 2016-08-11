import Ember from 'ember';

export default Ember.Route.extend({

  store: Ember.inject.service(),

  prefetch() {
    return Ember.RSVP.hash({
      adventures: this.store.findAll('adventure', {}),
      // slots: this.store.findAll('slot', {})
    });
  }
});