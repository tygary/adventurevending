import json
from models.adventure import AdventureModel


class AdventureInterpreter:

    def interpret(self, filePath):
        with open(filePath) as data_file:
            data = json.load(data_file)

        adventures = []

        for adventureConfig in data["adventures"]:
            adventures.append(AdventureModel(adventureConfig))

        return adventures