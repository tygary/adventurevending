import DS from 'ember-data';
const attr = DS.attr;

export default DS.Model.extend({
  location: attr('number'),
  isEmpty: attr('boolean', { defaultValue: false }),
  cost: attr('number', { defaultValue: 1 })
});
