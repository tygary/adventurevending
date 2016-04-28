import BaseAdapter from 'av-frontend/adapters/base';

export default BaseAdapter.extend({
  adventureCounter: 0,

  generateIdForRecord(store) {
    let adventureCounter = this.get('adventureCounter');

    while(store.peekRecord('adventure', adventureCounter)) {
      adventureCounter++;
    }

    this.set('adventureCounter', adventureCounter);
    return adventureCounter;
  }
});