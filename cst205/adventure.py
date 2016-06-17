# '''
# Enhydra Solutions - NorCal Division
# Austin Hesemayer, Joe Sarabia, Wayne Webster
# CST205
# Final Project
# '''


#####
# Start of class defintions
#####
######
# new state class to track win/loss states, may eventually use state to track current location within the game
class State:

  def __init__(self):
    self.win_states = {}
    self.loss_states = {}
    
  def add_win_state(self, room, item):
    self.win_states[room] = item
    
  def add_loss_state(self, room, item):
    self.loss_states[room] = item
    
  def check_for_win(self, room):
    has_won = false
    if room in self.win_states:
      winning_item = self.win_states[room]
      if winning_item == '' or winning_item in room.player_inventory:
        has_won = true
    
    return has_won
      
      
  def check_for_loss(self, room):
    has_lost = false
    if room in self.loss_states:
      losing_item = self.loss_states[room]
      if losing_item == ''or losing_item in room.player_inventory:
        has_lost = true
    
    return has_lost
      
# this is mostly complete, waiting on actual images instead of just black/white squares
class Map:

  def __init__(self, levels=1):
    self.maps = {}  
    for level in range(0, levels):
      self.maps[level + 1] = makeEmptyPicture(300, 500, black)
    self.map = self.maps[1] # start on the first level
    self.rooms = {}
    

  def show_map(self, room):
    if room in self.rooms:
      self.get_map(room).repaint()
    
  def add_room(self, room, level, x_start, y_start):
    self.rooms[room] = {}
    self.rooms[room]['level'] = level
    self.rooms[room]['x_start'] = x_start
    self.rooms[room]['y_start'] = y_start
  
  # currently unused
  def update_map(self):
    for room in self.rooms.keys():
      if room.is_entered:
        printNow("Drawing %s" % room)
        self.draw_room(room)
        
  def get_map(self, room):
    self.map = self.maps[self.rooms[room]['level']]
    return self.map
        
  def draw_room(self, room):
    if room in self.rooms and 'x_start' in self.rooms[room] and 'x_start' in self.rooms[room]:
      x_offset = self.rooms[room]['x_start']
      y_offset = self.rooms[room]['y_start']
    
      if 'file' in room.image:
        #in this section we will paint the image
        #debug: printNow("printing room image to map")
        
        if not 'image' in self.rooms[room]:
          self.rooms[room]['image'] =  makePicture(room.image['file'])
        
        room_image = self.rooms[room]['image']
          
        width = getWidth(room_image)
        height = getHeight(room_image)
        
        self.rooms[room]['width'] = width
        self.rooms[room]['height'] = height
        
        for x in range(x_offset, x_offset + width):
          for y in range(y_offset, y_offset + height):
            room_pixel = getPixel(room_image, x - x_offset, y - y_offset)
            setColor(getPixel(self.get_map(room), x, y), getColor(room_pixel))
        
        self.show_map(room)
            
  def draw_player(self, room):
    if room in self.rooms and 'x_start' in self.rooms[room] and 'x_start' in self.rooms[room]:
      x_offset = self.rooms[room]['x_start']
      y_offset = self.rooms[room]['y_start']

      width = 20
      height = 20
      start_x = int((2 * x_offset + self.rooms[room]['width'] - width) / 2)
      start_y = int((2 * y_offset + self.rooms[room]['height'] - height) / 2)
      
      #debug only
      #printNow("draw player at start x: %d start y: %d on level %d" % (start_x, start_y, self.rooms[room]['level']))

      addOvalFilled(self.get_map(room), start_x, start_y, width, height, red)
      
      self.show_map(room)
      
  def erase_player(self, room):
    if room in self.rooms and 'x_start' in self.rooms[room] and 'x_start' in self.rooms[room]:
      x_offset = self.rooms[room]['x_start']
      y_offset = self.rooms[room]['y_start']

      width = 20
      height = 20
      start_x = int((2 * x_offset + self.rooms[room]['width'] - width) / 2)
      start_y = int((2 * y_offset + self.rooms[room]['height'] - height) / 2)
      
      #debug only
      #printNow("erase player at start x: %d start y: %d on level %d" % (start_x, start_y, self.rooms[room]['level']))
      
      # This needs to be fixed to repaint the appropriate part of the room image instead of just white
      #addOvalFilled(self.get_map(room), start_x, start_y, width, height, white)
      
      if 'image' in self.rooms[room]:
        room_image = self.rooms[room]['image']
        
        for x in range(start_x, start_x + width):
          for y in range(start_y, start_y + height):
            room_pixel = getPixel(room_image, x - x_offset, y - y_offset)
            setColor(getPixel(self.get_map(room), x, y), getColor(room_pixel))
          
      
      self.show_map(room)
      
  def enter_room(self, room):
    if not room.is_entered:
       room.is_entered = true
       self.draw_room(room)  
    self.draw_player(room)
  
  def leave_room(self, room):
    self.erase_player(room)

# '''
# The Room class defines an abstraction for one of the core entities in this adventure game: the rooms which make up the map of the game's world.
#
# Class Variables:
# player_inventory - used to store player's inventory which is shared amongst rooms in the game, allowing player to "carry around" items
#
# Instance Variables:
# name - string containing name of room, used mostly in console output messages
# description - string containing a lengthy description also used for console output messages, should give hints on navigation and potentially 
#               items to interact with
# objects - array containing the items in the room which the user can interact with
# valid_moves - a dictionary that defines how the room is connected to other parts of the game's world. keys are a valid navigation direction,
#               and values are the instance of a Room which is in that direction (these moves are displayed to players)
# secret_moves - a dictionary similar to valid_moves, except these values are not displayed to players, this along with valid_moves defines how
#                this room is connected to the rest of the game world
# '''
class Room:

  player_inventory = []

  
  # '''
  # Description: Initalizes instances of class with several instance variables
  #
  # Intended Use: by game designer
  # '''
  def __init__(self, name, description):
    self.name = name
    self.description = description
    self.objects = []
    self.valid_moves = {}
    self.secret_moves = {}
    self.image = {}           # eventually, this will hold an image and possibly coordinates, might not be necessary with planned Map class
    self.is_entered = false   # this will be used to determine the state of a room and whether it should be drawn on the map
  
  
  # '''
  # Description: Defines the string representation of a Room instance
  #
  # Intended Use: internal
  # '''
  def __str__(self):
    return self.name
  
  
  # '''
  # Description: Adds an Item instance to the Room instance, used during game initialization
  #
  # Intended Use: by game designer
  # '''
  def add_object(self, object):
    self.objects.append(object)
  
  
  # '''
  # Description: Adds a connection between this room and other rooms in the world, direction is a string containing the direction to travel,
  #              room is an instance of Room that is in that specified direction, used during game initialization.  Moves added by this
  #              function will be visible to players.
  #
  # Intended Use: by game designer
  # '''
  def add_nav(self, direction, room):
    self.valid_moves[direction] = room
  
  
  # '''
  # Description: Adds a connection between this room and other rooms in the world, direction is a string containing the direction to travel,
  #              room is an instance of Room that is in that specified direction, used during game initialization.  Moves added by this
  #              function will not be visible to players, use this function to create secret navigation between rooms in the world.
  #
  # Intended Use: by game designer
  # '''
  def add_secret_nav(self, direction, room):
    self.secret_moves[direction] = room
  

  # '''
  # Description: Adds path to an image file representing this room. This image will be drawn onto the game's map when players enter the room.
  #
  # Intended Use: by game designer
  # '''
  def add_image(self, img_file='', width = 0, height = 0):
    if img_file:
      self.image['file'] = img_file
    
    # these eventually will be derived from the supplied image, unless it ends up more
    # useful to derive these direct from the pic object
    self.image['width'] = width
    self.image['height'] = height
  
  # '''
  # Description: Displays a list of valid moves to a player at the beggining of each move. This helps the player navigate through the game.
  #
  # Intended Use: system use during game play, used by startGame()
  # ''' 
  def show_moves(self):
    printNow("The following moves are valid: ")
    for move in self.valid_moves:
      printNow(move)
  
  
  # '''
  # Description: Searches for a specified instance of an Item by name that exists either in the room or within an opened container in that room
  #
  # Intended Use: system use during game play, used by the command parser
  # '''
  #!TODO: this might make more sense to move out of the class definition.
  def check_for_item(self, requested_item):
    for item in self.objects:
      if item.name.lower() == requested_item:
        return item
      elif item.state == 'opened':
        for nested_item in item.contents:
          if nested_item.name.lower() == requested_item:
            return nested_item
    
    return False
  
  
  # '''
  # Description: Displays this instance's room description at the beginning of each move
  #
  # Intended Use: system use during game play, used by startGame()
  # '''
  def show_description(self):
    printNow(self.description)

  
  # '''
  # Description: Displays this instance's room name at the beginning each move
  #
  # Intended Use: system use during game play, used by startGame()
  # '''  
  def show_room(self):
    printNow("----- %s -----" % self.name)
  

  # '''
  # Description: Defines a loss condition where if the player enters the dungeon they lose the game
  #
  # Intended Use: system use during game play, used by startGame()
  #
  # Change Log: 2016.04.11 - Changed info dislay from printNow() to showInformation().
  #                          Display playername when game is lost.
  # '''  
  def lose_game(self,playername):
    room = self.name
    if room == 'Dungeon':
      self.show_room()
      self.show_description()
      showInformation(playername + ', you are locked in the Dungeon.\n' + '------GAME OVER------')
      return true
    else:
      return false


  # '''
  # Description: Defines a win condition where if the player has the grail they win the game
  #
  # Intended Use: system use during game play, used by startGame()
  #
  # Change Log: 2016.04.11 - Changed info dislay from printNow() to showInformation().
  #                          Display playername when game is won.
  # '''  
  def win_game(self,foo,playername):
    item=self.player_inventory
    if foo in item:
      showInformation(playername + ", you have found the grail, you quickly exit the building before the occupants discover it missing! Well done, you have won!")
      printGoodbye()
      return true
    else:
      return false


  # '''
  # Description: Shows all instances of Item in the room and any instances of Item in an opened container
  #
  # Intended Use: system use during game play, used by startGame()
  # '''  
  def show_objects(self):
    if len(self.objects) > 0:
      printNow("The following items are in the room: ")
      for item in self.objects:
        printNow(item)
        #debug: printNow(item.state)
        #debug: printNow(item.valid_actions)
        
        if item.state == 'opened':
          for nested_item in item.contents:
            printNow(nested_item)
            #debug: printNow(nested_item.state)
            #debug: printNow(nested_item.valid_actions)

  
  # '''
  # Description: Shows all the items in the player's inventory
  #
  # Intended Use: system use during game play, used by startGame()
  # '''     
  def show_inventory(self):
    if len(self.player_inventory) > 0:
      info = "You are holding the following items: "
      for item in self.player_inventory:
        info += "\n%s" % item
      
      showInformation(info)
    else:
      showInformation("You have no items in your inventory")


  # '''
  # Description: Transfers the requested item from the room or from the container (an open item) to the player's inventory
  #
  # Intended Use: system use during game play, used by processCommand()
  # '''  
  def transfer_to_inventory(self, item):
    self.player_inventory.append(item)
    if item in self.objects:
      self.objects.remove(item)
    else:
      for container in self.objects:
        if container.state == 'opened':
          if item in container.contents:
            container.contents.remove(item)
    
# '''
# The Item class defines an abstraction for one of the core entities in this adventure game: the items which players interact with.
# Item instances can be either in an instance of a Room or in an instance of another Item, such as a container. Only one level of such
# item nesting is supported.
#
# Class Variables:
# none
#
# Instance Variables:
# name - string containing name of item, used mostly in console output messages
# description - string containing a lengthy description which is intend for console output messages, should give hints on navigation and potentially 
#               items to interact with
# valid_actions - a dictionary that defines the actions that are allowed on an instance of Item and which state the instance must be in for that 
#                 action to be performed, keys are the permitted action and values are the required state.
# protected_actions - a dictionary that defines actions that can only be performed on this instance of an Item if some other instance of an Item
#                     is present in the player's inventory, keys are the protected action, and values are the instance of an Item required for that
#                     action 
# self_state - a string containing the current state of the Item, used to define whether an Item is owned (in inventory) and also used along
#              with valid_actions to control the permitted actions on an Item
# contents - an array which defines any items contained within this item, used to provide an Item that functions as a container
# '''
class Item:
  
  
  # '''
  # Description: Initalizes instances of class with several instance variables
  #
  # Intended Use: by game designer
  # '''
  def __init__(self, name, state):
    self.name = name
    self.description = '' #currently unused
    self.valid_actions = {}
    self.protected_actions = {}
    self.state = state
    self.contents = []
  
  
  # '''
  # Description: Defines the string representation of an Item instance
  #
  # Intended Use: internal
  # '''
  def __str__(self):
    return self.name
  

  # '''
  # Description: Adds an Item instance to this container, used during game initialization
  #
  # Intended Use: by game designer
  # '''
  def insert_item(self, item):
    self.contents.append(item)
  

  # '''
  # Description: Adds an action that is allowed to be performed on this Item, used during game initialization
  #
  # Intended Use: by game designer
  # '''
  def add_action(self, action, state):
    self.valid_actions[action] = state
  

  # '''
  # Description: Defines a protected action which requires the use of some Item to perform the actdion, used during game initialization
  #
  # Intended Use: by game designer
  # '''
  def add_protected_action(self, action, item):
    self.protected_actions[action] = item
  

  # '''
  # Description: Used to show Items within this container
  #
  # Intended Use: system during game play, used by processCommand()
  # '''
  def show_contents(self):
    info = ''
    if len(self.contents) > 0:
      info = "You see the following items in the %s:" % self
      for item in self.contents:
        info += "\n%s" % item
    
    if info:
      showInformation(info)
    else:
      showInformation("There is nothing in the %s." % self)

  # '''
  # Description: Used to take an action on this Item, action contains a string which represents a command that has already been parsed
  #              and validated against a global white list of commands. Determines whether an action is protected and whether the required
  #              item is in the player's inventory. Validates whether the requested action is allowed on this item. Changes the state of the item.  
  #
  # Intended Use: system during game play, used by processCommand()
  #
  # Change Log: 2016.04.11 - Changed info dislay from printNow() to showInformation().
  #                          
  # '''
  def take_action(self, action):
    #debug: printNow("Attempting to " + action + " " + self.name)
    
    action = action.lower()
    
    if action in self.protected_actions:
      if self.protected_actions[action] not in Room.player_inventory:
        showInformation("You are missing something needed to %s this item." % action)
        return False
    
    if action in self.valid_actions:
      if self.state == self.valid_actions[action]:
        if action == 'get':
          self.state = 'owned'
        elif action == 'unlock':
          self.state = 'unlocked'
        elif action == 'lock':
          self.state = 'locked'
        elif action == 'open':
          self.state = 'opened'
        elif action == 'close':
          self.state = 'closed'
        elif action in ['inspect', 'look']:
          self.show_contents()
        return True
      else:
        showInformation("You need to do something else before you can %s it." % action)
    else:
        showInformation("You can't %s this item." % action)
    
    return False
#####
# End of class definitions
#####

#####
# Start of helper functions
#####

# '''
# Description: Print a helpful messsage with basic instructions when the game starts, also responds to help command.
#
# Intended Use: system during game play, used by startGame()
#
# Change Log: 2016.04.11 - Changed info dislay from printNow() to showInformation().
#                          Display playername during welcome message.
# '''
def printWelcome(playername):
  showInformation("*** Welcome to 205 Adventure Land! *** " + \
                  playername + ", you have entered the lair of Enhydra Solutions, NorCal Division. " + \
                  "In each room you will be told which directions you can go. " + \
                  "You will be able to go north, south, east or west by typing that direction. " + \
                  "Type help to redisplay this introduction. " + \
                  "Type exit to quit at any time.")


# '''
# Description: Print a message when the player elects to exit the game.
#
# Intended Use: system during game play, used by startGame()
# '''
def printGoodbye():
  printNow("So long, thanks for visiting.")


# '''
# Description: Print an error message with the player tries to move in an invalid direction.
#
# Intended Use: system during game play, used by startGame()
#
# Change Log: 2016.04.11 - Changed info dislay from printNow() to showInformation().
# '''  
def printError():
  showInformation("You can't move that way")
  

# '''
# Description: Process the player's request. This function services to provide a global parser and whitelist
#              of player's provided input. Determine if it is a permitted navigation command or system command. In the case of
#              compound commands, parse the command to separate the action from object, and validate that the action is allowed.
#              Also wraps logic around picking up items in a room or in an item, as permitted. Returns True when a player is
#              attempting to perform a move to another room.
#
# Intended Use: system during game play, used by startGame()
#
# Change Log: 2016.04.11 - Changed info dislay from printNow() to showInformation().
#                          Updated function to accept a name, which is passed to the printWelcome() function as required.
# '''  
def processCommand(command, room, name):
  permitted_commands = ('north', 'south', 'east', 'west', 'up', 'down',
                     'inventory',
                     'exit', 'help')
  
  compound_commands = ('open', 'close', 'drink', 'take', 'get', 'lock', 'unlock', 'inspect', 'look')
  
  noun = ''
  verb = ''
  
  # parse compound command
  parsed_command = command.split(None, 1)
 
  
  if len(parsed_command) == 2:
    verb = parsed_command[0]
    noun = parsed_command[1]
  elif len(parsed_command) == 1:
    verb = parsed_command[0]
  
  # '''
  # #debug only
  # if verb:
  #   printNow("command: " + verb)
  # if noun:
  #   printNow("object: " + noun)
  # '''
  
  if verb not in permitted_commands and verb not in compound_commands:
    showInformation("%s is not an allowed command. Please try again." % command)
    return False
  elif command == 'exit':
    printGoodbye()
    return False
  elif command == 'help':
    printWelcome(name)
    return False
  elif command == 'inventory':
    room.show_inventory()
    return False
  elif verb in compound_commands:
    if len(command.split()) == 1:
      showInformation("What do you want to %s?" % command)
    elif len(command.split()) == 2:
      
      foundItem = room.check_for_item(noun)
      
      if foundItem:
        if foundItem.take_action(verb) and foundItem.state == 'owned':
          room.transfer_to_inventory(foundItem)
      else:
        showInformation("You can't do anything with the %s." % noun)
          
  else:
    # this is an attempt to move rooms
    return True


# '''
# Description: Prompts the player for an action to perform
#
# Intended Use: system during game play, used by startGame()
# ''' 
def getCommand():
  command = ''
  
  while not command:
    command = requestString("What would you like to do?")
  
  return command.lower()


# '''
# Description: Moves the player from one room to another
#
# Intended Use: system during game play, used by startGame()
# '''   
def moveRooms(direction, room):
  if direction in room.valid_moves:
    return room.valid_moves[direction]
  elif direction in room.secret_moves:
    return room.secret_moves[direction]
  else:
    return False

#####
# End of helper functions
#####


#####
# Main Execution Function
#####


# '''
# Description: Starts the game. First creates and intializes all the rooms in the game, then builds the map. Then, initializes
#              and populates the world with items for the player to interact with. Finally, enters a control loop which controls
#              the interaction with the user during each move.
#
# Intended Use: run by player
#
# Change Log: 2016.04.11 - Request playername before the game starts, used to personalize game play throughout the game.
# '''  
def startGame():

  rootFolder = os.path.dirname(os.path.abspath(startGame.func_code.co_filename))
  #debug: printNow(rootFolder)
 
  # these are the descriptions for each room 
  entranceDescriber = 'Ahead of you lies a large wooden gate. The gate seems to be unlocked.'
  entranceRoomDescriber = 'You have stepped into a enormous cave looking room that is dimly lit by a large chandelier.' \
    + ' In the flickering light you can see several different doorways.'
  diningDescriber = ' A massive table adorned with plates and goblets that seems to never end lies in the middle of the room.' \
    + ' While admiring the scenary you see another door to your East.'
  kitchenDescriber = 'Ahh, a room that seems to have all the food in the world. But no time for eating now, it looks like ' \
    + 'there is a passage way behind the pantry.' 
  stairwellDescriber = 'There seems to be a narrow stairwell that leads up to a dark room '
  hallwayDescriber = 'A torch lit hallway lies before you that seems to lead to two rooms. The Northern rooms door seems ' \
    + 'to have been broken down. The Southern room has a metal barred door but it is unlocked.' 
  loot_roomDescriber = 'The room appears to have been ransacked, but in the middle of the room lies a large chest. '
  dungeonDescriber = 'The room is very dark and dirty,  set of shackels are attached to the wall........ SLAM!!!! ' \
    + ' The door slams behind you with no possible way out. '
  secret_roomDescriber = 'The room is pitch black but there seems to be something giving off a faint light in the corner. ' 
  
  # create a map for the world
  world = Map(levels=2)  
        
  # build the rooms in this world
  entrance = Room('Entrance', entranceDescriber)
  entrance_room = Room('Entrance Room', entranceRoomDescriber)
  dining_room = Room('Dining Hall', diningDescriber)
  kitchen = Room('Kitchen', kitchenDescriber)
  stairwell = Room('Stairwell', stairwellDescriber)
  hallway = Room('Hallway', hallwayDescriber)
  dungeon = Room('Dungeon', dungeonDescriber)
  loot_room = Room('Ransacked Room', loot_roomDescriber)
  secret_room = Room('Secret Room', secret_roomDescriber)
  
  # add room images
  entrance.add_image(img_file = rootFolder + '/images/Entrance.jpg')
  entrance_room.add_image(img_file = rootFolder + '/images/Entrance Room.jpg')
  dining_room.add_image(img_file = rootFolder + '/images/Dining Room.jpg')
  kitchen.add_image(img_file = rootFolder + '/images/Kitchen.jpg')
  stairwell.add_image(img_file = rootFolder + '/images/Secret Stairwell.jpg')
  hallway.add_image(img_file = rootFolder + '/images/Hallway.jpg')
  dungeon.add_image(img_file = rootFolder + '/images/Dungeon.jpg')
  loot_room.add_image(img_file = rootFolder + '/images/Loot Room.jpg')
  secret_room.add_image(img_file = rootFolder + '/images/SecretRoom.jpg')
    
  # now, add navigation between the rooms
  entrance.add_nav('south', entrance_room)
  entrance_room.add_nav('north', entrance)
  entrance_room.add_nav('east', hallway)
  entrance_room.add_nav('south', dining_room)
  dining_room.add_nav('north', entrance_room)
  dining_room.add_nav('east', kitchen)
  kitchen.add_nav('west', dining_room)
  kitchen.add_secret_nav('east', stairwell)
  stairwell.add_nav('west', kitchen)
  stairwell.add_nav('up', secret_room)
  secret_room.add_nav('down', stairwell)
  hallway.add_nav('west', entrance_room)
  hallway.add_nav('north', loot_room)
  hallway.add_nav('south', dungeon)
  loot_room.add_nav('south', hallway)
  dungeon.add_nav('north', hallway)
  
  # add rooms to the map
  world.add_room(entrance, 1, 0, 0)
  world.add_room(entrance_room, 1, 0, 100)
  world.add_room(hallway, 1, 100, 100)
  world.add_room(dining_room, 1, 0, 200)
  world.add_room(kitchen, 1, 100, 300)
  world.add_room(loot_room, 1, 100, 0) 
  world.add_room(dungeon, 1, 100, 200)
  world.add_room(stairwell, 1, 200, 300)
  world.add_room(secret_room, 2, 200, 400)
  
  # create and place inventory items
  key = Item('Key', 'unowned')
  key.add_action('get', 'unowned')
  
  # corner is an abstract item, that acts as an opened container for the key
  corner = Item('Corner', 'opened')
  corner.add_action('inspect', 'opened')
  corner.insert_item(key)
  secret_room.add_object(corner)
  
  chest = Item('Chest', 'locked')
  chest.add_action('unlock','locked')
  chest.add_protected_action('unlock', key)
  chest.add_action('open','unlocked')
  chest.add_action('inspect', 'opened')
  grail = Item('Grail', 'unowned')
  grail.add_action('get', 'unowned')
  chest.insert_item(grail)
  loot_room.add_object(chest)
  
  
  # finally, setup win/loss conditions
  adventure = State()
  adventure.add_win_state(loot_room, grail)
  adventure.add_loss_state(dungeon, '')
    
  playername=requestString("What is your name?")
  printWelcome(playername)
   
  # start game at the entrance
  currentRoom = entrance
  currentRoom.is_entered = true
  world.draw_room(currentRoom)
  world.draw_player(currentRoom)
  #world.show_map(currentRoom)
  
  command = ''
  
  while command != 'exit':
  
    currentRoom.show_room()
    currentRoom.show_description()
    currentRoom.show_moves()
    
    #in previous versions, these were displayed automatically
    #currentRoom.show_objects()
    #currentRoom.show_inventory()
    
    #debug only
    #for room in world.rooms:
    #  printNow("Room: %s Is Entered: %s" % (room, room.is_entered))
    
    command = getCommand()
    tryRoomMove = processCommand(command, currentRoom, playername)

    if tryRoomMove:
      newRoom = moveRooms(command, currentRoom)
      if newRoom:
        world.leave_room(currentRoom)
        world.enter_room(newRoom)
        currentRoom = newRoom      
      else:
        printError()
    
    #may deprecate this in favor of world.draw_room()
    #world.update_map()
    
    #world.show_map(currentRoom)
    
    if adventure.check_for_win(currentRoom):
      printNow("Won!")
    if adventure.check_for_loss(currentRoom):
      printNow("Lost!")
        
    #check for win/loss
    if currentRoom.lose_game(playername):
      break
    if currentRoom.win_game(grail,playername):
      break   
                  
  #clean-up here
  world.show_map(currentRoom)
  
  #clear player's inventory     
  Room.player_inventory = []

      
       
    
  
  
  
  
  
  

 

