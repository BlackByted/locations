import sys
import geocoder

lat = sys.argv[1]
long = sys.argv[2]
loc = geocoder.osm([lat,long], method='reverse')
print(loc.postal)