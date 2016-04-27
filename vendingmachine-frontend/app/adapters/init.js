import Ember from 'ember';
import DS from 'ember-data';

export default DS.RESTAdapter.extend({
  queryRecord: function(store, type, query) {
    return new Ember.RSVP.Promise(function(resolve, reject) {
      Ember.$.getJSON('http://localhost:8000/api/init', query).then(function(data) {
        Ember.run(null, resolve, data);
      }, function(jqXHR) {
        jqXHR.then = null; // tame jQuery's ill mannered promises
        Ember.run(null, reject, jqXHR);
      });
    });
  }
});