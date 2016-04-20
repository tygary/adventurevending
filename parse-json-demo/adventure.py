class Adventure:

  def __init__(self, config):
    self.title = config['title']
    self.description = config['description']
    self.enabled = config['enabled']
    self.coinValue = config['coinValue']
    self.startTime = config['startTime']
    self.endTime = config['endTime']
    self.genres = config['genres']

  def debug(self):
    print self.title
    print self.description
    print self.enabled
    print self.coinValue
    print self.startTime
    print self.endTime
    print self.genres
