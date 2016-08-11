from kinet import *
# see https://github.com/vishnubob/kinet

#TODO, fix but in kinet library that chooses wifi interface when avalible

#ethernet attached power supply.
#The PowerSupply class inherits from list
ip_address = "192.168.1.120"
pds = PowerSupply(ip_address)


#TODO, read from config file that includes fixures and starting addresses,
#TODO, create simple UI for setting number of fixtures and addresses

# address light fixtures using lowest dmx address
# example if using RGB addresses 3,4,5 choose 5
fix00 = FixtureRGB(64)
fix01 = FixtureRGB(25)
fix02 = FixtureRGB(19)
#fix03 = FixtureRGB(0)
#fix04 = FixtureRGB(0)
#fix05 = FixtureRGB(0)
#fix06 = FixtureRGB(0)
#fix07 = FixtureRGB(0)
#fix08 = FixtureRGB(0)
#fix09 = FixtureRGB(0)
#fix10 = FixtureRGB(0)
#fix11 = FixtureRGB(0)
#fix12 = FixtureRGB(0)
#fix13 = FixtureRGB(0)
#fix14 = FixtureRGB(0)
#fix15 = FixtureRGB(0)
#fix16 = FixtureRGB(0)
#fix17 = FixtureRGB(0)
#fix18 = FixtureRGB(0)
#fix19 = FixtureRGB(0)
#fix20 = FixtureRGB(0)
#fix21 = FixtureRGB(0)
#fix22 = FixtureRGB(0)
#fix23 = FixtureRGB(0)

# Attach each of the 24 light fixtures to the power supply
# TODO, automate appending based on the number of fixtures defined.
pds.append(fix00)
pds.append(fix01)
pds.append(fix02)
#pds.append(fix03)
#pds.append(fix04)
#pds.append(fix05)
#pds.append(fix06)
#pds.append(fix07)
#pds.append(fix08)
#pds.append(fix09)
#pds.append(fix10)
#pds.append(fix11)
#pds.append(fix12)
#pds.append(fix13)
#pds.append(fix14)
#pds.append(fix15)
#pds.append(fix16)
#pds.append(fix17)
#pds.append(fix18)
#pds.append(fix19)
#pds.append(fix20)
#pds.append(fix21)
#pds.append(fix22)
#pds.append(fix23)

#Remove this, just for testing lights
#pds[1].rgb = (0, 0, 0)
#pds[0].rgb = (255, 255, 255)
#pds.go()
#time.sleep(0.1)

# example of how to use the FadeIter
def fader(pds1, cnt):
    pds2 = pds1.copy()
    while cnt:
        pds1[random.randint(0, 2)][random.randint(0, 2)] = random.randint(0, 255)
        pds2[random.randint(0, 2)][random.randint(0, 2)] = random.randint(0, 255)
        print "%s => %s" % (pds1, pds2)
        fi1 = FadeIter(pds1, pds2, .5)
        fi2 = FadeIter(pds2, pds1, .5)
        fi1.go()
        fi2.go()
        pds1.clear()
        pds2.clear()
        cnt -= 1

def selectBox(pds, box, pause=.1, steps=255):
    div = steps / len(pds)
    box = box -1
    for step in range(steps):
        ratio = 0
        for idx, fixture in enumerate(pds):

            if idx == box:
              #if this is the selected prize then turn white
              #TODO make light pulse
              pds[idx].rgb = (255, 255, 255)

            else:
              #if not the prize box do a slow rainbow patern
              ratio += (step + idx * div) % steps / float(steps)
              fixture.hsv = (ratio, 1.0, 1.0)
        print pds
        pds.go()
        time.sleep(pause)

def openBox(pds, box):
  #TODO write a light show to celebrate when a box is opened
  #for now this is just the same routine for select box but faster
  #not sure if this looks good or not
      selectBox(pds, box, steps=10)

def idle(pds, pause=.1, steps=255):
    steps= 1000
    pause= 0.1
    div = steps / len(pds)
    for step in range(steps):
        ratio = 0
        for idx, fixture in enumerate(pds):
            ratio += (step + idx * div) % steps / float(steps)
            fixture.hsv = (ratio, 1.0, 1.0)
        print pds
        pds.go()
        time.sleep(pause)


#TODO, write a idle routine that is more aware of the placement of lights and does a cool animation


#TODO, add a test here to change the prize box every few seconds to simulate user input
#TODO, use the fader class to transition between user inputs
#selectBox(pds, 6)

time.sleep(1)
openBox(pds, 3)
time.sleep(2)
openBox(pds, 2)
idle(pds)


