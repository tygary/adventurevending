import Ember from 'ember';

export default Ember.Route.extend({
  prefetch(params) {
    let id = params.gift_id;
    let record = this.store.peekRecord('gift', id);

    if (record === null) {
      record = this.store.find('gift', id);
    }

    return record;
  }
});