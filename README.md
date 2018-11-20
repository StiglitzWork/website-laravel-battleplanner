# Run the redis server (leave running)
redis-server --port 3001

# Run the node server in the root of the app (leave running)
sudo node socket.js


# TODO
Edited: src and floorNum
/*Oregon Second*/ ['name'=> "second", 'src'=> "/media/maps/Clean/Oregon/Second.jpg", 'floorNum'=>2, 'map_id'=>Map::byName("oregon")->id],

Added
/*Oregon Tower*/ ['name'=> "tower", 'src'=> "/media/maps/Clean/Oregon/Tower.jpg", 'floorNum'=>3, 'map_id'=>Map::byName("oregon")->id],

Edited: src and floorNum
/*Oregon Roof*/ ['name'=> "roof", 'src'=> "/media/maps/Clean/Oregon/Roof.jpg", 'floorNum'=>4, 'map_id'=>Map::byName("oregon")->id],
