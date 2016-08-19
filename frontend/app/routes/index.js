import Ember from 'ember';

export default Ember.Route.extend({

  queryParams: {
    page: {
      refreshModel: true
    }
  },

  store: Ember.inject.service(),

  prefetch(params) {

    return Ember.RSVP.hash({
      adventures: this.store.query('adventure', params.queryParams)
    });
  }
});
