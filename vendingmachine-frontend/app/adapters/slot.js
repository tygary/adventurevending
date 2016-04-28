import BaseAdapter from 'av-frontend/adapters/base';

export default BaseAdapter.extend({
  slotCounter: 0,

  generateIdForRecord(store) {
    let slotCounter = this.get('slotCounter');

    while(store.peekRecord('slot', slotCounter)) {
      slotCounter++;
    }

    this.set('slotCounter', slotCounter);
    return slotCounter;
  }
});