import DS from 'ember-data';

export default DS.Model.extend({
  thing: DS.attr('string'),
  // adventures: DS.hasMany('adventure', {async: true}),
  // gifts: DS.hasMany('gift', {async: true})
});