import BaseAdapter from 'av-frontend/adapters/base';

export default BaseAdapter.extend({
  giftCounter: 0,

  generateIdForRecord(store) {
    let giftCounter = this.get('giftCounter');

    while(store.peekRecord('gift', giftCounter)) {
      giftCounter++;
    }

    this.set('giftCounter', giftCounter);
    return giftCounter;
  }
});