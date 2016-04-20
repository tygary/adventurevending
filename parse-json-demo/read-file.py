import json
from adventure import Adventure

with open('file.json') as data_file:
  data = json.load(data_file)

for adventureConfig in data["adventures"]:
  print adventureConfig
  adventure = Adventure(adventureConfig)
