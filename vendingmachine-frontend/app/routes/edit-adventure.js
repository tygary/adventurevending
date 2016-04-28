import Ember from 'ember';

export default Ember.Route.extend({
  prefetch(params) {
    let id = params.adventure_id;
    let record = this.store.peekRecord('adventure', id);

    if (record === null) {
      record = this.store.find('adventure', id);
    }

    return record;
  }
});