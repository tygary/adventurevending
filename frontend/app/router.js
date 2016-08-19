import Ember from 'ember';
import config from './config/environment';

const Router = Ember.Router.extend({
  location: config.locationType
});

Router.map(function() {
  this.route('edit-adventure', { path: '/edit-adventure/:adventure_id' });
});

export default Router;
